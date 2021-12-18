<?php

class Error_controller extends Controller {

    function action_index()
    {
        $this->view->generate('error_view.php', 'template_view.php');
    }
}