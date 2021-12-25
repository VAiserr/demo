<?php

class Aplication_controller extends Controller
{
    function __construct()
    {
        $this->model = new Aplication_model();
        $this->view = new View();
    }

    function action_index()
    {
        session_start();
        if (isset($_SESSION["user"])) {
            $id = $_SESSION["user"]["id"];
            $this->view->generate(
                'cabinet_view.php',
                'template_view.php',
                ["categories" => $this->model->categories, "data" => $this->model->get_user_data($id)]
            );
        } else Controller::redirect("/login");
    }

    function add()
    {
        if (empty($_POST))
            $err[] = "Ошибка добавления заявки";

        if (!isset($err)) {
            $this->model->post_data($_POST);
            Controller::redirect("/profile");
        } else {
            $this->view->generate('cabinet_view.php', 'template_view.php', ["categories" => $this->model->categories, "errs" => $err]);
        }
    }

    function change() {
        session_start();
        if (isset($_SESSION["user"])) {
            $id = $_SESSION["user"]["id"];
            $this->view->generate('cabinet_view.php', 'template_view.php', ["data" => $this->model->get_user_data($id)]);
        } else Controller::redirect("/login");
    }

}
