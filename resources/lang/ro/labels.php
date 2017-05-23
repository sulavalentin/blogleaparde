<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Языковые ресурсы названий Labels
    |--------------------------------------------------------------------------
    |
    | Следующие языковые ресурсы используются в названиях
    | Labels всего вашего приложения.
    | Вы можете свободно изменять эти языковые ресурсы в соответствии
    | с требованиями вашего приложения.
    |
    */

    'backend'   => [
        'access'    => [
            'roles' => [
                'create'        => 'Creaza rol nou',
                'edit'          => 'Modifica rol',
                'management'    => 'Permisiune',
                'table'         => [
                    'number_of_users'   => 'Utilizatori',
                    'permissions'       => 'Permisiuni',
                    'role'              => 'Rol',
                    'sort'              => 'Pozaitie',
                    'total'             => 'roluri',
                ],
            ],
            'users' => [
                'active'                => 'Utilizatori activi',
                'all_permissions'       => 'Control total',
                'change_password'       => 'Modifica parola',
                'change_password_for'   => 'Modifica parola pentru :user',
                'create'                => 'Creaza profil',
                'deactivated'           => 'Utilizatori blocati',
                'deleted'               => 'Utilizatori sters',
                'edit'                  => 'Profiluri modificate',
                'management'            => 'Utilizatori',
                'no_permissions'        => 'Nu sunt permisiuni',
                'no_roles'              => 'Imposibil rol.',
                'permissions'           => 'Permisiuni',
                'table'                 => [
                    'confirmed'         => 'Confirmat',
                    'created'           => 'Creat',
                    'email'             => 'E-mail',
                    'id'                => 'ID',
                    'last_updated'      => 'Modificat',
                    'name'              => 'Login',
                    'no_deactivated'    => 'Nu sunt utilizatori blocati',
                    'no_deleted'        => 'Nu sunt utilizatori stersi',
                    'roles'             => 'Roluri',
                    'total'             => 'utilizatori totali|total utilizatori',
                ],
                'tabs'                  => [
                    'content'   => [
                        'overview'  => [
                            'avatar'        => 'Avatar',
                            'confirmed'     => 'Confirmat',
                            'created_at'    => 'Creat',
                            'deleted_at'    => 'Sters',
                            'email'         => 'E-mail',
                            'last_updated'  => 'Modificat',
                            'name'          => 'Login',
                            'status'        => 'Status',
                        ],
                    ],
                    'titles'    => [
                        'history'   => 'Istorie',
                        'overview'  => 'Previzualizare',
                    ],
                ],
                'view'                  => 'Priveste profilul',
            ],
        ],
    ],
    'frontend'  => [
        'auth'      => [
            'login_box_title'       => 'Logare',
            'login_button'          => 'Intra',
            'login_with'            => 'Intra din :social_media',
            'register_box_title'    => 'Inregistrare',
            'register_button'       => 'Inregistrare',
            'remember_me'           => 'Salveaza numele',
        ],
        'macros'    => [
            'country'           => [
                'alpha'     => 'Alfa coduri tari',
                'alpha2'    => 'Alfa-2 coduri tari',
                'alpha3'    => 'Alfa-3 cuduri tari',
                'numeric'   => 'Country Numeric Codes',
            ],
            'macro_examples'    => 'Exemple macro',
            'state'             => [
                'mexico'    => 'Lista staturilor Mexic',
                'us'        => [
                    'armed'     => 'US Armed Forces',
                    'outlying'  => 'inconjurarile USA',
                    'us'        => 'USA',
                ],
            ],
            'territories'       => [
                'canada'    => 'Провинции Канады & Территории',
            ],
            'timezone'          => 'Timpul local',
        ],
        'passwords' => [
            'forgot_password'                   => 'Ai uitat parola?',
            'reset_password_box_title'          => 'Reseteaza parola',
            'reset_password_button'             => 'Modifica parola',
            'send_password_reset_link_button'   => 'Trimite linkul pentru',
        ],
        'user'      => [
            'passwords' => [
                'change'    => 'Modifica parola',
            ],
            'profile'   => [
                'avatar'                => 'Avatar',
                'created_at'            => 'Creat',
                'edit_information'      => 'Informatie modificata',
                'email'                 => 'E-mail',
                'last_updated'          => 'Modificat',
                'name'                  => 'Login',
                'update_information'    => 'Informatie Modificata',
            ],
        ],
    ],
    'general'   => [
        'actions'           => 'Actiuni',
        'active'            => 'Activat',
        'all'               => 'Toti',
        'buttons'           => [
            'save'      => 'Salveaza',
            'update'    => 'Modifica',
        ],
        'custom'            => 'Costum',
        'hide'              => 'Ascunde',
        'inactive'          => 'Neactiv',
        'no'                => 'Nu',
        'none'              => 'Nimic',
        'show'              => 'Arata',
        'toggle_navigation' => 'Navigare',
        'yes'               => 'Da',
    ],
];
