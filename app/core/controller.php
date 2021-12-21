<?php

class Controller
{

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    function redirect($to)
    {
        // code...
    }

    // Метод action, вызываемое по умолчанию
    function action_index()
    {
        // code...
    }
}
