<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Языковые ресурсы вывода оповещений
    |--------------------------------------------------------------------------
    |
    | Следующие языковые ресурсы используются для вывода
    | сообщений в различных сценариях CRUD.
    | Вы можете свободно изменять эти языковые ресурсы в соответствии
    | с требованиями вашего приложения.
    |
    */

    'backend'   => [
        'roles' => [
            'created'   => 'Noul rol a fost creat.',
            'deleted'   => 'Rolul a fost sters.',
            'updated'   => 'Rol modificat.',
        ],
        'users' => [
            'confirmation_email'    => 'Parametri noi pentru verificare au fost trimisi pe E-mail.',
            'created'               => 'Utilizatorul nou a fost creat.',
            'deleted'               => 'Utilizator sters.',
            'deleted_permanently'   => 'Utilizatorul a fost sters pe tot deauna.',
            'restored'              => 'Utilizatorul a fost reinitializat.',
            'session_cleared'      => "The user's session was successfully cleared.",
            'updated'               => 'Parametri utilizatorului au fost modificate.',
            'updated_password'      => 'Parola utilizatorului a fost modificata.',
        ],
    ],
];
