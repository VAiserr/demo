<?php

include 'app/models/aplication_model.php';

class Main_controller extends Controller
{

    function __construct()
    {
        $this->model = new Aplication_model;
        $this->view = new View;
    }

    function action_index()
    {
        $this->view->generate(
            'main_view.php', 
            'template_view.php',
            [
                "categories" => $this->model->categories,
                "aplications" => $this->model->get_decided()
            ]
        );
    }
}
