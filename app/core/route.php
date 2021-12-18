<?php

/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/
class Route
{
    static function start()
    {
        // Контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';

        // Разделение адресса страницы на состовляющие
        $routes = explode('/', $_SERVER["REQUEST_URI"]);

        // Получаем имя контроллера
        if (!empty($routes[1])) {
            $controller_name = $routes[1];
        }

        // Получаем имя action
        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }

        // Добавляем префиксы
        $model_name = $controller_name . '_model';
        $controller_name .= '_controller';
        $action_name = 'action_' . $action_name;

        echo "Model: $model_name <br>";
        echo "Controller: $controller_name <br>";
        echo "Action: $action_name <br>";

        // Подключаем файл с кслассом модели (файла может и не быть)
        $model_file = strtolower($model_name);
        $model_path = "app/models" . $model_file;
        if (file_exists($model_path)) {
            include "app/models/" . $model_file;
        }

        // Подключаем файл с классом контроллера
        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = 'app/controllers/' . $controller_file;
        if(file_exists($controller_path)) {
            /*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу Error
			*/
            include $controller_path;
        } else {
            Route::ErrorPage404();
        }

        // Создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;

        if (method_exists($controller, $action)) {
            // Вызываем действие контроллера
            $controller->$action();
        } else {
            // здесь также разумнее было бы кинуть исключение
            echo "Контроллер $controller_name не существует";
            Route::ErrorPage404();
        }
    }

    static function ErrorPage404()
    {
        $host = 'http://' . $_SERVER["HTTP_HOST"] . '/';
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        header('Location:' . $host . 'error');
    }
}
