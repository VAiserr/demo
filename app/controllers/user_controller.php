<?php

class User_controller extends Controller
{

    function __construct()
    {
        $this->model = new User_model;
        $this->view = new View();
    }

    function login_form()
    {
        $this->view->generate('login_view.php', 'template_view.php');
    }

    function register_form($data)
    {
        $this->view->generate('register_view.php', 'template_view.php', $data);
    }

    function login()
    {
        print_r($_POST);
    }

    function register()
    {
        if (empty($_POST["login"]))
            $err[] = 'Поле Логин не может быть пустым!';

        if (empty($_POST["password"]))
            $err[] = 'Поле Пароль не может быть пустым';

        if (isset($err)) {
            User_controller::register_form($err);
        } else {
            $login = $_POST["login"];
            $password = $_POST["password"];

            $this->model->post_data($_POST);
        }
    }

    function logout()
    {
    }
}
