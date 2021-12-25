<?php

include 'category_model.php';

class Aplication_model extends Model
{
    function __construct()
    {
        $this->categories = Category_model::get_categories();
    }

    function get_data()
    {
        global $mysqli;
        $res = $mysqli->query("SELECT * FROM `aplicatins`");
        while ($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
        }
        return $result ?? null;
    }

    function get_user_data($id)
    {
        global $mysqli;
        $sql = "SELECT * FROM `aplications` WHERE `user_id` = $id";
        $res = $mysqli->query($sql);
        while ($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
        }
        return $result ?? null;
    }

    function post_data($data)
    {
        session_start();

        global $mysqli;
        $title = $data["title"];
        $description = $data["description"];
        $user = $_SESSION["user"]["id"];
        $category = $data["category"];
        $image = "image/";
        print_r($data);

        $sql = "INSERT INTO `aplications` (`title`, `description`, `user_id`, `category_id`, `image_before`)
                VALUES ('$title', '$description', '$user', '$category', '$image')";
        $mysqli->query($sql);
        echo "успех";
    }
}
