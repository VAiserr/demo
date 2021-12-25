<?php

class Controller
{

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    static function redirect($to)
    {
        $host = 'http://' . $_SERVER["HTTP_HOST"];
        header("Location: $host" . $to);
    }

    // Метод action, вызываемое по умолчанию
    function action_index()
    {
        // code...
    }
}
