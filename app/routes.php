<?php
$routes = explode('/', $_SERVER["REQUEST_URI"]);

print_r($routes);
echo '<br>';

switch ($routes[1]) {
    case '':
        Route::start();
        break;
    case 'login':
        if (!empty($routes[2]))
            Route::start('User', 'login');
        else
            Route::start('User', 'login_form');
        break;
    case 'register':
        if (!empty($routes[2]))
            Route::start('User', 'register');
        else
            Route::start('User', 'register_form');
        break;

    default:
        Route::start('error');
}
