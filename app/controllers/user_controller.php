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
        $this->view->generate('login_view.php', 'login_view.php', ["title" => "Авторизация"]);
    }

    function register_form()
    {
        $this->view->generate('register_view.php', 'register_view.php', ["title" => "Регистрация"]);
    }

    function login()
    {
        if (empty($_POST["login"]) && empty($_POST["email"]))
            $err[] = "Нужно заполнить хоть одно из двух полей";

        if (empty($_POST["password"]))
            $err[] = "Поле Пароль не может быть пустым";
        else {

            $login = $this->model->get_login($_POST["login"])["login"] ?? '';
            $email = $this->model->get_email($_POST["email"])["email"] ?? '';
            $password = $this->model->get_user(empty($_POST["login"]) ? $_POST["email"] : $_POST["login"], $_POST["password"]) ?? '';
            if (empty($login) && empty($email) || empty($password))
                $err[] = "Неверно введен логин или пароль";
        }
        if (isset($err)) {
            $this->view->generate(
                'login_view.php',
                'login_view.php',
                ["errs" => $err, "user" => $_POST, "title" => "Авторизация"]
            );
        } else {
            $user = $this->model->get_user(empty($login) ? $email : $login, $_POST['password']);
            session_start();
            $_SESSION["user"] = $user;
            Controller::redirect('/');
        }
    }

    function register()
    {
        // var_dump($_POST);
        if (empty($_POST["FIO"]))
            $err[] = 'Поле ФИО не может быть пустым!';

        // if (!preg_match('/^[А-я\-]/',$_POST["FIO"]))
        //     $err[] = 'ФИО может содержать только кириллицу, дефис и пробелы';

        if (empty($_POST["login"]))
            $err[] = 'Поле Логин не может быть пустым!';

        if (empty($_POST["email"]))
            $err[] = 'Поле Почта не может быть пустым!';

        if (empty($_POST["password"]))
            $err[] = 'Поле Пароль не может быть пустым!';

        if (empty($_POST["confirm"]))
            $err[] = 'Поле Подтвердите пароль не может быть пустым!';

        if ($_POST["password"] != $_POST["confirm"])
            $err[] = 'Пароль не подтвержден';

        $login = $this->model->get_login($_POST["login"]) ?? '';
        if ($login) {
            $err[] = "Данный логин занят";
        }

        $email = $this->model->get_email($_POST["email"]) ?? '';
        if ($email) {
            $err[] = "Данная почта уже зарегистрирована";
        }

        if (isset($err)) {
            $this->view->generate(
                'register_view.php',
                'register_view.php',
                ["errs" => $err, "user" => $_POST, "title" => "Регистрация"]
            );
        } else {
            $this->model->post_data($_POST);
            session_start();
            $user = $this->model->get_user($_POST["login"], $_POST['password']);
            $_SESSION["user"] = $user;
            Controller::redirect('/');
        }
    }

    function logout()
    {
        session_start();
        session_unset();
        Controller::redirect('/');
    }
}
