<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Языковые ресурсы системы записи истории
    |--------------------------------------------------------------------------
    |
    | Следующие языковые ресурсы используются в названиях
    | системы ведения записи истории приложения.
    | Вы можете свободно изменять эти языковые ресурсы в соответствии
    | с требованиями вашего приложения.
    |
    */

    'backend'   => [
        'none'              => 'Nu sunt inregistrari in istorie.',
        'none_for_entity'   => 'Nu sunt inregistrari in istorie pentru :entity.',
        'none_for_type'     => 'Nu este istorie pentru acest tip.',
        'recent_history'    => 'Ultima inregistrare in istorie',
        'roles'             => [
            'created'   => 'a creat rol',
            'deleted'   => 'a sters rol',
            'updated'   => 'a modificat rol',
        ],
        'users'             => [
            'changed_password'      => 'a modificat parola utilizatorului',
            'created'               => 'a creat profil',
            'deactivated'           => 'a blocat profil',
            'deleted'               => 'a sters profil',
            'permanently_deleted'   => 'a sters pe todeauna profil',
            'reactivated'           => 'a dezblocat profilul',
            'restored'              => 'a reintors profilul',
            'updated'               => 'a modificat profilul',
        ],
    ],
];
