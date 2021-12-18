<?php 

class Controller {

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    // Метод action, вызываемое по умолчанию
    function action_index()
    {
        // code...
    }
}