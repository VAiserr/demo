<?php
class Error_controller extends Controller {

    function action_index()
    {
        $this->view->generate('error_view.php', 'template_view.php',["title" => "Ошибка"]);
    }

    function accessDenied() {
        $this->view->generate('accessDenied_view.php', 'template_view.php',["title" => "Ошибка"]);
    }
}