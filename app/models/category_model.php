<?php

class Category_model extends Model
{

    static function get_categories()
    {
        global $mysqli;
        $sql = "SELECT * FROM `categories`";
        $result = mysqli_fetch_all($mysqli->query($sql));

        return $result;
    }
}
