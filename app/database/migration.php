<?php

require_once 'db_connect.php';

function getMigrationFiles($conn) {
    // Находим папку с миграциями
    $sqlFolder = str_replace('\\', '/', realpath(dirname(__FILE__)) . '/') . 'sql/';
    // Получаем список всех sql файлов
    $allFiles = glob($sqlFolder . '*.sql');

    // Ищем существующие миграции
    $migrationFiles = array();
    $query = "SELECT `name` FROM `migrations`";
    $res = mysqli_query($conn, $query);
    // если таблицы нет, возвращаем все файлы из папки sql
    if (!$res)
        return $allFiles;
    $data = mysqli_fetch_all($res);
    foreach ($data as $row) {
        array_push($migrationFiles, $sqlFolder . $row["name"]);
    }
    // возвращаем все файлы, которых нет в таблице migrations
    return array_diff($allFiles, $migrationFiles);
}

function migrate($conn, $file) {
    require_once 'config.php';
    // Формируем команду выполнения mysql-запроса из внешнего файла
    $command = sprintf('mysql -u%s -p%s -h %s -D %s < %s', $dbuser, $dbpassword, $dbhost, $dbname, $file);
    // Выполняем shell-скрипт
    if (shell_exec($command)) {
        echo $baseName . "Загружено <br>";
    } else {
        echo $baseName . "ошибка загрузки <br>";
    }

    // вытаскиваем имя файла, отбрасив путь
    $baseName = basename($file);
    // Формируем запрос для добавления миграции в таблицу migrations
    $query = "INSERT INTO `migration` (`name`) VALUES('$baseName')";
    // Выполняем запрос
    mysqli_query($conn,$query);
}

// Получаем список файлов для миграций за исключением тех, которые уже есть в таблице versions
$files = getMigrationFiles($mysqli);
// Проверяем, есть ли новые миграции
if (empty($files))
    echo 'Миграция не требуется <br>';
else {
    foreach ($files as $file) {
        migrate($mysqli, $file);

        echo basename($file) . "<br>";
    }
}
