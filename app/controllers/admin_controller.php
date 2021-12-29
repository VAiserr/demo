<?php

include 'app/models/aplication_model.php';

class Admin_controller extends Controller
{

    function __construct()
    {
        $this->model = new Aplication_model;
        $this->view = new View;
    }

    function action_index()
    {
        $_SESSION["status_filter"] = @$_GET["status"];
        $action = Admin_controller::get_aps($_SESSION["status_filter"]);
        $aps = $this->model->$action();
        $this->view->generate(
            'aplications_view.php',
            'template_view.php',
            [
                "title" => "Заявки",
                "aps" => $aps,
                "categories" => $this->model->categories
            ]
        );
    }

    function change()
    {
        if (empty($_POST["status"]))
            $err[] = "Ошибка отправления данных";
        else {
            if ($_POST["status"] == 2) {
                $img = @$_FILES["image"];
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
                    $image_path = "./images/after/";

                    $filesize = filesize($img["tmp_name"]);
                    $filesize /= (1024 * 1024);
                    if ($filesize > 10)
                        $err[] = "Размер изображения не должен превышать 10Мб";

                    move_uploaded_file($img["tmp_name"], $image_path . $image_name);
                    if (!file_exists($image_path . $image_name))
                        $err[] = "Изображение не удалось сохранить";
                }
            } else if ($_POST["status"] == 3) {
                if (empty(@$_POST["cause"]))
                    $err[] = "Поле Причина не может быть пустым";
                
            } else {
                $err[] = "Неверный статус";
            }
        }

        if (isset($err)) {
            $action = Admin_controller::get_aps($_SESSION["status_filter"]);
            $aps = $this->model->$action();
            $this->view->generate(
                'aplications_view.php', 
                'template_view.php',
                [
                    "title" => "Заявки",
                    "aps" => $aps,
                    "categories" => $this->model->categories,
                    "errs" => $err
                ]
            );
        } else {
            $result = $_POST;
            $result["image"] = @$image_name;
            $this->model->change_status($result);
            Controller::redirect('/aplications?status=' . $_SESSION["status_filter"]);
        }
    }

    function delete() {
        if (!empty($_GET["id"])) {
            $this->model->delete_data($_GET["id"]);
            Controller::redirect('/aplications?status=' . $_SESSION["status_filter"]);
        }
    }

    static function get_aps($filter) {
        switch ($filter) {
            case "new":
                $result = 'get_new';
                break;
            case "decided":
                $result = 'get_decided';
                break;
            case "declined":
                $result = 'get_declined';
                break;
            default:
                $result = 'get_data';
                $_SESSION["status_filter"] = "";
        }
        return $result;
    }
}
