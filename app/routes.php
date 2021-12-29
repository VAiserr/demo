<?php
session_start();
$user = @$_SESSION["user"];
$routes = explode('/', $_SERVER["REQUEST_URI"]);
$location = @explode('?', $routes[1])[0];
$action = @explode('?', $routes[2])[0];

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
        if (isset($user)) {
            if (!empty($action))
                switch ($action) {
                    case 'add-aplication':
                        Route::start('Aplication', 'add');
                        break;
                    case 'change-aplication':
                        Route::start('Aplication', 'change');
                        break;

                    default:
                        Route::start('error');
                }
            else Route::start('Aplication');
        } else Route::start('User', 'login_form');
        break;

    case 'category':
        if (isset($user)) {
            if($user["status"]) {
                if (!empty($action)) {
                    switch ($action) {
                        case 'add':
                            Route::start('Category','add');
                            break;
                        case 'delete':
                            Route::start('Category','delete');
                            break;

                        default:
                            Route::start('error');
                    }
                } else Route::start("Category");
            } else Route::accessDenied();
        } else Route::start('User', 'login_form');
        break;

    case 'aplications':
        if (isset($user)) {
            if ($user["status"]) {
                if (!empty($action)) {
                    switch ($action) {
                        case 'change':
                            Route::start('Admin','change');
                            break;
                        case 'delete':
                            Route::start('Admin','delete');
                            break;

                        default:
                            Route::start('error');
                    }
                } else Route::start("Admin");
            } else Route::accessDenied();
        } else Route::start('User', 'login_form');
        break;

    case 'accessDenied':
        Route::start('error','accessDenied');
        break;
    default:
        Route::start('error');
}
