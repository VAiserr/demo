<?php

class Category_controller extends Controller
{

    function __construct()
    {
        $this->model = new Category_model();
        $this->view = new View();
    }

    function action_index()
    {
        $this->view->generate(
            "categoryForm_view.php",
            "template_view.php",
            [
                "title" => "Категории",
                "categories" => $this->model->get_categories()
            ]
        );
    }

    function add()
    {
        if (empty($_POST["category-add"]))
            $err[] = "Введите категорию";
        else {
            foreach ($this->model->get_categories() as $item) {
                if ($_POST["category-add"] == $item["category"])
                    $err[] = "Такая категория уже есть";
            }
        }
        if (!isset($err)) {
            $this->model->post_data($_POST);
            Controller::redirect('/category');
        } else {
            $this->view->generate(
                "categoryForm_view.php",
                "template_view.php",
                [
                    "title" => "Категории",
                    "categories" => $this->model->get_categories(),
                    "add_errs" => $err
                ]
            );
        }
    }

    function delete() {
        if (empty($_POST["category-del"]))
            $err[] = "Выбирите категорию";
        else {
            $flag = true;
            foreach ($this->model->get_categories() as $item) {
                if ($_POST["category-del"] == $item["id"])
                    $flag = false;
            }
            if ($flag)
                $err[] = "Такой категории нет";
        }

        if (!isset($err)) {
            $this->model->delete_data($_POST);
            Controller::redirect('/category');
        } else {
            $this->view->generate(
                "categoryForm_view.php",
                "template_view.php",
                [
                    "title" => "Категории",
                    "categories" => $this->model->get_categories(),
                    "del_errs" => $err
                ]
            );
        }
    }
}
