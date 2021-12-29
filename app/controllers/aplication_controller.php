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
                [
                    "categories" => $this->model->categories,
                    "aplications" => $this->model->get_user_data($id),
                    "title" => "Личный кабинет"
                ]
            );
        } else Controller::redirect("/login");
    }

    function add()
    {
        $app_title = @$_POST["title"];
        $description = @$_POST["description"];
        $category = @$_POST["category"];
        $img = @$_FILES["image"];
        if (empty($app_title))
            $err[] = "Поле Название не может быть пустым!";

        if (empty($description))
            $err[] = "Поле Описание не может быть пустым!";

        if (empty($category))
            $err[] = "Выберите категорию";

        if (empty($img["name"])) {
            $err[] = "Файл не выбран";
        } else {
            $file = @getimagesize($img["tmp_name"]);
            if (empty($file))
                $err[] = "Файл не является изображением";

            switch ($file["mime"]) {
                case "image/png":
                    $ext = ".png";
                    break;
                case "image/jpeg":
                    $ext = ".jpg";
                    break;
                case "image/bmp":
                    $ext = ".bmp";
                    break;
                default:
                    $err[] = "Неверный формат изображения";
            }

            $image_name = time() . $ext;
            $image_path = "./images/before/";

            $filesize = filesize($img["tmp_name"]);
            $filesize /= (1024 * 1024);
            if ($filesize > 10)
                $err[] = "Размер изображения не должен превышать 10Мб";

            move_uploaded_file($img["tmp_name"], $image_path . $image_name);
            if (!file_exists($image_path . $image_name))
                $err[] = "Изображение не удалось сохранить";
        }

        if (!isset($err)) {
            $this->model->post_data([
                "title" => $app_title,
                "description" => $description,
                "category" => $category,
                "image_name" => $image_name
            ]);
            Controller::redirect("/profile");
        } else {
            $id = $_SESSION["user"]["id"];
            $this->view->generate(
                'cabinet_view.php', 
                'template_view.php', 
                [
                    "categories" => $this->model->categories, 
                    "aplications" => $this->model->get_user_data($id),
                    "errs" => $err
                ]);
        }
    }

    function change()
    {
        session_start();
        if (isset($_SESSION["user"])) {
            $id = $_SESSION["user"]["id"];
            $this->view->generate('cabinet_view.php', 'template_view.php', ["data" => $this->model->get_user_data($id)]);
        } else Controller::redirect("/login");
    }

    function delete() {
        if (!empty($_GET["id"])) {
            $user_id = $_SESSION["user"]["id"];
            $id = $_GET["id"];
            $aplication = $this->model->get_aplication($id);
            if ($aplication["user_id"] == $user_id) {
                $this->model->delete_data($id);
                Controller::redirect('/profile');
            }
        }
    }
}
