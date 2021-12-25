<?php

class User_model extends Model
{

    function get_data()
    {
        global $mysqli;
        $sql = "SELECT * FROM `users`";
        $result = mysqli_fetch_all(mysqli_query($mysqli, $sql));

        return $result;
    }

    function get_user($login, $password)
    {
        global $mysqli;
        $email = filter_var($login, FILTER_VALIDATE_EMAIL) ? $login : '';
        if (!empty($email)) {
            $sql = "SELECT * FROM `users`
                    WHERE `email` = '$email'";
        } else {
            $sql = "SELECT * FROM `users`
                    WHERE `login` = '$login'";
        }

        $user = mysqli_fetch_assoc($mysqli->query($sql));
        if ($user)
            if ($user["password"] == $password)
                return $user;
        return null;
    }

    function get_login($login)
    {
        global $mysqli;
        $sql = "SELECT `login` FROM `users`
                WHERE `login` = '$login'";
        $result = mysqli_fetch_assoc(mysqli_query($mysqli, $sql));
        if (!empty($result)) {
            return $result;
        }
        return;
    }

    function get_email($email)
    {
        global $mysqli;
        $sql = "SELECT `email` FROM `users`
                WHERE `email` = '$email'";
        $result = mysqli_fetch_assoc(mysqli_query($mysqli, $sql));
        if (!empty($result)) {
            return $result;
        }
        return;
    }

    function post_data($data)
    {
        global $mysqli;
        $FIO = $data["FIO"];
        $login = $data["login"];
        $email = $data["email"];
        $password = $data["password"];
        $sql = "INSERT INTO `users` (`FIO`, `login`, `email`, `password`)
                VALUES ('$FIO', '$login', '$email', '$password')";
        mysqli_query($mysqli, $sql);
    }
}
