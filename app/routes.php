<?php
$routes = explode('/', $_SERVER["REQUEST_URI"]);
$location = $routes[1];
$action = @explode('?', $routes[2])[0];
print_r($action);
echo '<br>';

switch ($location) {
    case '':
        Route::start();
        break;
    case 'login':
        if (!empty($action))
            Route::start('User', 'login');
        else
            Route::start('User', 'login_form');
        break;
    case 'register':
        if (!empty($action))
            Route::start('User', 'register');
        else
            Route::start('User', 'register_form');
        break;
    case 'logout':
        Route::start('User', 'logout');
        break;

    case 'profile':
        if (!empty($action))
            switch ($action) {
                case 'add':
                    Route::start('Aplication', 'add');
                    break;
                case 'change-aplication':
                    Route::start('Aplication', 'change');
                    break;

                default:
                    Route::start('error');
            }
        else Route::start('Aplication');
        break;

    default:
        Route::start('error');
}
