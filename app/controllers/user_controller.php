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
        if (empty($_POST["login"] && empty($_POST["email"])))
            $err[] = "Нужно заполнить хоть одно из двух полей";

        if (empty($_POST["password"]))
            $err[] = "Поле Пароль не может быть пустым";

        $login = $this->model->get_login();

        if (isset($err)) {
            $this->view->generate(
                'login_view', '', ["errs" => $err, "data" => $_POST]
            );
        } else {

        }
    }

    function register()
    {
        if (empty($_POST["FIO"]))
            $err[] = 'Поле ФИО не может быть пустым!';

        if (empty($_POST["login"]))
            $err[] = 'Поле Логин не может быть пустым!';

        if (empty($_POST["email"]))
            $err[] = 'Поле Почта не может быть пустым!';

        if (empty($_POST["password"]))
            $err[] = 'Поле Пароль не может быть пустым!';

        $login = $this->model->get_login($_POST["login"]) ?? '';
        if ($login) {
            $err[] = "Данный логин занят";
        }

        $email =$this->model->get_email($_POST["email"]) ?? '';
        if ($email) {
            $err[] = "Данная почта уже зарегистрирована";
        }

        if (isset($err)) {
            $this->view->generate(
                'register_view.php', 'template_view.php', ["errs" => $err, "data" => $_POST]
            );
        } else {
            $this->model->post_data($_POST);
        }
    }

    function logout()
    {
    }
}
