<?php

namespace App\Repositories\Frontend\Access\User;

use App\Models\Access\User\User;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\Access\User\SocialLogin;
use App\Events\Frontend\Auth\UserConfirmed;
use App\Repositories\Backend\Access\Role\RoleRepository;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = User::class;

    /**
     * @var RoleRepository
     */
    protected $role;

    /**
     * @param RoleRepository $role
     */
    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }

    /**
     * @param $email
     *
     * @return mixed
     */
    public function findByEmail($email)
    {
        return $this->query()->where('email', $email)->first();
    }

    /**
     * @param $token
     *
     * @throws GeneralException
     *
     * @return mixed
     */
    public function findByConfirmationToken($token)
    {
        return $this->query()->where('confirmation_code', $token)->first();
    }

    /**
     * @param $token
     *
     * @return mixed
     */
    public function findByPasswordResetToken($token)
    {
        foreach (DB::table(config('auth.passwords.users.table'))->get() as $row) {
            if (password_verify($token, $row->token)) {
                return $this->findByEmail($row->email);
            }
        }

        return false;
    }

    /**
     * @param $token
     *
     * @throws GeneralException
     *
     * @return mixed
     */
    public function getEmailForPasswordToken($token)
    {
        $rows = DB::table(config('auth.passwords.users.table'))->get();

        foreach ($rows as $row) {
            if (password_verify($token, $row->token)) {
                return $row->email;
            }
        }

        throw new GeneralException(trans('auth.unknown'));
    }
    protected function getFirstLastNames($fullName)
    {
        $parts = array_values(array_filter(explode(" ", $fullName)));

        $size = count($parts);

        if(empty($parts)){
            $result['first_name']   = NULL;
            $result['last_name']    = NULL;
        }

        if(!empty($parts) && $size == 1){
            $result['first_name']   = $parts[0];
            $result['last_name']    = NULL;
        }

        if(!empty($parts) && $size >= 2){
            $result['first_name']   = $parts[0];
            $result['last_name']    = $parts[1];
        }

        return $result;
    }
    /**
     * @param array $data
     * @param bool  $provider
     *
     * @return static
     */
    public function create(array $data, $provider = false)
    {
        $user = self::MODEL;
        $user = new $user;
        if(!empty($data['name'])){
            $data=$this->getFirstLastNames($data['name']);
        }
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        if(!empty($data['username'])){
            $user->username = $data['username'];
        }
        $user->email = $data['email'];
        $user->confirmation_code = md5(uniqid(mt_rand(), true));
        $user->status = 1;
        $user->password = $provider ? null : bcrypt($data['password']);
        $user->confirmed = $provider ? 1 : (config('access.users.confirm_email') ? 0 : 1);

        DB::transaction(function () use ($user) {
            if ($user->save()) {
                /*
                 * Add the default site role to the new user
                 */
                $user->attachRole($this->role->getDefaultUserRole());
            }
        });

        /*
         * If users have to confirm their email and this is not a social account,
         * send the confirmation email
         *
         * If this is a social account they are confirmed through the social provider by default
         */
        if (config('access.users.confirm_email') && $provider === false) {
            $user->notify(new UserNeedsConfirmation($user->confirmation_code));
        }

        /*
         * Return the user object
         */
        return $user;
    }
    protected function getFirstLastNamesBase($fullName,$result)
    {
        $parts = array_values(array_filter(explode(" ", $fullName)));

        $size = count($parts);

        if(empty($parts)){
            $result->first_name   = NULL;
            $result->last_name    = NULL;
        }

        if(!empty($parts) && $size == 1){
            $result->first_name   = $parts[0];
            $result->last_name    = NULL;
        }

        if(!empty($parts) && $size >= 2){
            $result->first_name   = $parts[0];
            $result->last_name   = $parts[1];
        }

        return $result;
    }
    protected function getFirstLastNamesBaseGoogle($fullName,$result)
    {
        $result->first_name   = $fullName['givenName'];
        $result->last_name   = $fullName['familyName'];
        return $result;
    }
    /**
     * @param $data
     * @param $provider
     *
     * @return UserRepository|bool
     * @throws GeneralException
     */
    public function findOrCreateSocial($data, $provider)
    {
        // User email may not provided.
        $user_email = $data->email ?: "{$data->id}@{$provider}.com";

        // Check to see if there is a user with this email first.
        $user = $this->findByEmail($user_email);

        /*
         * If the user does not exist create them
         * The true flag indicate that it is a social account
         * Which triggers the script to use some default values in the create method
         */
        if (! $user) {
            // Registration is not enabled
            if (! config('access.users.registration')) {
                throw new GeneralException(trans('exceptions.frontend.auth.registration_disabled'));
            }
            /*if name is string for facebook*/
            if(!empty($data['name']) && ! is_array($data['name'])){
                $data=$this->getFirstLastNamesBase($data['name'],$data);
            }
            /*if name is array for google*/
            if(!empty($data['name']) &&  is_array($data['name'])){
                $data=$this->getFirstLastNamesBaseGoogle($data['name'],$data);
            }
            $user = $this->create([
                'first_name'  => $data->first_name,
                'last_name'  => $data->last_name,
                'email' => $user_email,
            ], true);
        }

        // See if the user has logged in with this social account before
        if (! $user->hasProvider($provider)) {
            // Gather the provider data for saving and associate it with the user
            $user->providers()->save(new SocialLogin([
                'provider'    => $provider,
                'provider_id' => $data->id,
                'token'       => $data->token,
                'avatar'      => $data->avatar,
            ]));
        } else {
            // Update the users information, token and avatar can be updated.
            $user->providers()->update([
                'token'       => $data->token,
                'avatar'      => $data->avatar,
            ]);
        }

        // Return the user object
        return $user;
    }

    /**
     * @param $token
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function confirmAccount($token)
    {
        $user = $this->findByConfirmationToken($token);

        if ($user->confirmed == 1) {
            throw new GeneralException(trans('exceptions.frontend.auth.confirmation.already_confirmed'));
        }

        if ($user->confirmation_code == $token) {
            $user->confirmed = 1;

            event(new UserConfirmed($user));

            return $user->save();
        }

        throw new GeneralException(trans('exceptions.frontend.auth.confirmation.mismatch'));
    }

    /**
     * @param $id
     * @param $input
     *
     * @throws GeneralException
     *
     * @return mixed
     */
    public function updateProfile($id, $input)
    {
        $user = $this->find($id);
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];

        if ($user->canChangeEmail()) {
            //Address is not current address
            if ($user->email != $input['email']) {
                //Emails have to be unique
                if ($this->findByEmail($input['email'])) {
                    throw new GeneralException(trans('exceptions.frontend.auth.email_taken'));
                }

                // Force the user to re-verify his email address
                $user->confirmation_code = md5(uniqid(mt_rand(), true));
                $user->confirmed = 0;
                $user->email = $input['email'];
                $updated = $user->save();

                // Send the new confirmation e-mail
                $user->notify(new UserNeedsConfirmation($user->confirmation_code));

                return [
                    'success' => $updated,
                    'email_changed' => true,
                ];
            }
        }

        return $user->save();
    }

    /**
     * @param $input
     *
     * @throws GeneralException
     *
     * @return mixed
     */
    public function changePassword($input)
    {
        $user = $this->find(access()->id());

        if (Hash::check($input['old_password'], $user->password)) {
            $user->password = bcrypt($input['password']);

            return $user->save();
        }

        throw new GeneralException(trans('exceptions.frontend.auth.password.change_mismatch'));
    }
}
