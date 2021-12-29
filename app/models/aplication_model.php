<?php

include 'category_model.php';
include 'user_model.php';

class Aplication_model extends Model
{
    function __construct()
    {
        $this->categories = Category_model::get_categories();
    }

    function get_data()
    {
        global $mysqli;
        $res = $mysqli->query("SELECT * FROM `aplications`");
        while ($row = mysqli_fetch_assoc($res)) {
            Aplication_model::get_status($row);
            $result[] = $row;
        }
        return $result ?? null;
    }

    function get_aplication($id) {
        global $mysqli;
        return mysqli_fetch_assoc($mysqli->query("SELECT * FROM `aplications` WHERE `id` = $id"));
    }

    function get_user_data($id)
    {
        global $mysqli;
        $sql = "SELECT * FROM `aplications` WHERE `user_id` = $id
                ORDER BY `created_at` DESC";
        $res = $mysqli->query($sql);
        while ($row = mysqli_fetch_assoc($res)) {
            Aplication_model::get_status($row);
            $result[] = $row;
        }
        return $result ?? null;
    }

    function get_decided() {
        global $mysqli;
        $sql = "SELECT * FROM `aplications` WHERE `status` = 2
                ORDER BY `updated_at` DESC";
        $res = $mysqli->query($sql);
        while ($row = mysqli_fetch_assoc($res)) {
            $row["status"] = "Решенная";
            $row["status_class"] = "color-green";
            $result[] = $row;
        }
        return $result ?? null;
    }

    function get_new() {
        global $mysqli;
        $sql = "SELECT * FROM `aplications` WHERE `status` = 1
                ORDER BY `created_at` DESC";
        $res = $mysqli->query($sql);
        while ($row = mysqli_fetch_assoc($res)) {
            $row["status"] = "Новая";
            $row["status_class"] = "selected";
            $result[] = $row;
        }

        return @$result;
    }

    function get_declined() {
        global $mysqli;
        $sql = "SELECT * FROM `aplications` WHERE `status` = 3
                ORDER BY `created_at` DESC";
        $res = $mysqli->query($sql);
        while ($row = mysqli_fetch_assoc($res)) {
            $row["status"] = "Откланена";
            $row["status_class"] = "color-violet";
            $result[] = $row;
        }

        return @$result;
    }

    function post_data($data)
    {
        session_start();

        global $mysqli;
        $title = $data["title"];
        $description = $data["description"];
        $user = $_SESSION["user"]["id"];
        $category = $data["category"];
        $image = "/images/before/" . $data["image_name"];

        $sql = "INSERT INTO `aplications` (`title`, `description`, `user_id`, `category_id`, `image_before`)
                VALUES ('$title', '$description', '$user', '$category', '$image')";
        $mysqli->query($sql);
    }

    function delete_data($data) {
        global $mysqli;
        $mysqli->query("DELETE FROM `aplications` WHERE `id` = $data");
    }

    function change_status($data) {
        global $mysqli;
        $id = @$data["apl_id"];
        $status = @$data["status"];
        if ($status == 2) {
            $image_path = "/images/after/" . $data["image"];
            $sql = "UPDATE `aplications` SET `image_after` = '$image_path', `status` = $status
                    WHERE `id` = $id";
            $mysqli->query($sql);
        } else if ($status == 3) {
            $cause = $data["cause"];
            echo $cause;
            $sql = "UPDATE `aplications` SET `cause` = '$cause', `status` = $status
                    WHERE `id` = $id";
            $mysqli->query($sql);
        }
    }

    static function get_status(&$row) {
        switch(@$row["status"]) {
            case 1:
                $row["status"] = "Новая";
                $row["status_class"] = "selected";
                break;
            case 2:
                $row["status"] = "Решенная";
                $row["status_class"] = "color-green";
                break;
            case 3:
                $row["status"] = "Откланена";
                $row["status_class"] = "color-violet";
                break;

            default:
                return;
        }
    }
}
