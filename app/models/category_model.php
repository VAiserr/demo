<?php

class Category_model extends Model
{

    static function get_categories()
    {
        global $mysqli;
        $sql = "SELECT * FROM `categories`";
        $res = $mysqli->query($sql);
        while ($row = mysqli_fetch_assoc($res)) {
            $result[] = $row;
        }

        return $result;
    }

    function post_data($data) {
        global $mysqli;
        $cat = $data["category-add"];
        $sql = "INSERT INTO `categories` (`category`)
                VALUES ('$cat')";
        $mysqli->query($sql);
    }

    function delete_data($data) {
        global $mysqli;
        print_r($data);
        $id = $data["category-del"];
        $sql = "DELETE FROM `categories`
                WHERE `id` = $id";
        $mysqli->query($sql);
        $sql = "DELETE FROM `aplications`
                WHERE `category_id` = $id";
        $mysqli->query($sql);
    }
}
