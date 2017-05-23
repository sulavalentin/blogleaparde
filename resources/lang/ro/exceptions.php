<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Языковые ресурсы Исключений (Exception)
    |--------------------------------------------------------------------------
    | Следующие языковые ресурсы используются для вывода
    | сообщений перехвата Исключений (Exception) всего вашего приложения.
    | Вы можете свободно изменять эти языковые ресурсы в соответствии
    | с требованиями вашего приложения.
    |
    */

    'backend' => [
        'access' => [
            'roles' => [
                'already_exists'    => 'Aceasta denumire deja exista.Va rog alegeti alta',
                'cant_delete_admin' => 'Nu puteti sterge rolul de administrator.',
                'create_error'      => 'Nu puteti crea rolul.Incercati din nou.',
                'delete_error'      => 'Nu puteti sterge rolul.Incercati din nou',
                'has_users'         => 'Nu puteti sterge rolul.Este legata cu un utilizator existent.',
                'needs_permission'  => 'Trebuie sa alegeti macar o permisiune pentru acest rol.',
                'not_found'         => 'Rolul nu exista.',
                'update_error'      => 'Nu se poate de modificat rolul.Incercati din nou.',
            ],

            'users' => [
                'cant_deactivate_self'  => 'Pentru dvs nu puteti sa faceti asta.',
                'cant_delete_admin'  => 'You can not delete the super administrator.',
                'cant_delete_self'      => 'Nu puteti sa va stergeti.',
                'cant_delete_own_session' => 'You can not delete your own session.',
                'cant_restore'          => 'Utilizatorul nu poate fi sterge, pentru ca nu se poate de reintors.',
                'create_error'          => 'Imposibil de create utilizatorul. Reincercati din nou mai tirziu.',
                'delete_error'          => 'Nu se poate de sters utilizatorul. Reincercati din nou mai tirziu.',
                'delete_first'          => 'Utilizatorul trebuie sa fie sters inainte sa fie sters pe todeauna.',
                'email_error'           => 'Acest E-mail este ocupat.',
                'mark_error'            => 'Imposibil de modificat utilizatorul. Reincercati din nou mai tirziu.',
                'not_found'             => 'Acest utilizator nu exista.',
                'restore_error'         => 'Imposibil de reinoit utilizatorul. Reincercati din nou mai tirziu.',
                'role_needed_create'    => 'Trebuie sa alegeti macar un rol.',
                'role_needed'           => 'Trebuie sa alegeti minim un rol.',
                'session_wrong_driver'  => 'Your session driver must be set to database to use this feature.',
                'update_error'          => 'Imposibil de modificat utilizatorul. Reincercati din nou mai tirziu.',
                'update_password_error' => 'Imposibil de modificat parola utilizatorului. Reincercati din nou mai tirziu.',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => 'Accountul este deja confirmat.',
                'confirm'           => 'Confirmati profilul dvs!',
                'created_confirm'   => 'Profilul a fost creat cu succes. Am trimis un mesaj pe email pentru a condifrma .',
                'mismatch'          => 'Неправильный код подтверждения.',
                'not_found'         => 'Acest an nu exista.',
                'resend'            => 'Profilul dvs nu este confirmat. Va rugam sa apasati pe linkul din E-mail, sau <a href="'.route('frontend.auth.account.confirm.resend', ':user_id').'">apasati aici</a>, pentru a trimite din nou un E-mail.',
                'success'           => 'Profilul este confirmat cu succes!',
                'resent'            => 'Parametri noi au fost trimisi pe E-mail.',
            ],

            'deactivated' => 'Profilul dvs a fost dezactivat.',
            'email_taken' => 'Aceste E-mail este ocupat.',

            'password' => [
                'change_mismatch' => 'Parola veche incorecta.',
                'reset_problem' => 'There was a problem resetting your password. Please resend the password reset email.',
            ],

            'registration_disabled' => 'Inregistrarea la moment este inchisa.Reincercati din nou mai tirziu',
        ],
    ],
];
