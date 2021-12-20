<?php

require 'config.php';

$mysqli = @new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
@$mysqli->set_charset("utf8");

if ($mysqli->connect_errno) {
    die("Ошибка соединения: " . $mysqli->connect_errno . ".<br />Описание ошибки: " .  $mysqli->connect_error);
}
