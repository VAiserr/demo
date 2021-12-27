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
        switch (@$_GET["status"]) {
            case "new":
                $aps = $this->model->get_new();
                break;
            case "decided":
                $aps = $this->model->get_decided();
                break;
            case "declined":
                $aps = $this->model->get_declined();
                break;
            default:
                $aps = $this->model->get_data();
        }
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
            switch (@$_GET["status"]) {
                case "new":
                    $aps = $this->model->get_new();
                    break;
                case "decided":
                    $aps = $this->model->get_decided();
                    break;
                case "declined":
                    $aps = $this->model->get_declined();
                    break;
                default:
                    $aps = $this->model->get_data();
            }
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
            Controller::redirect('/aplications?status=new');
        }
    }
}
