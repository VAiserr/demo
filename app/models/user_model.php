<?php
require_once '../database/db_connect.php';


class User_model extends Model
{

    function get_data()
    {
        global $mysqli;
        $sql = "SELECT * FROM `users`";
        $result = mysqli_fetch_assoc(mysqli_query($mysqli, $sql));

        return $result;
    }

    function get_user($login, $password)
    {
        global $mysqli;
        $sql = "SELECT * FROM `users`
                WHERE `login` = '$login'";
        $user = mysqli_fetch_assoc(mysqli_query($mysqli, $sql));

        if ($user["password"] == $password)
            return $user;
        return null;
    }

    function post_data($data)
    {
        global $mysqli;
        $login = $data["login"];
        $password = $data["password"];
        $sql = "INSERT INTO `user`
                VALUES('', $login, $password)";
        mysqli_query($mysqli, $sql);
    }
}
