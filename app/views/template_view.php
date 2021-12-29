<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <!-- Стили -->
    <link rel="stylesheet" href="<?php echo 'http://' . $_SERVER["HTTP_HOST"] . '/css/style.css' ?>">
    <title>Document</title>
</head>
<?php
session_start();
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $name = $user["FIO"];
}
?>
<header class="header-page page-block">
    <div class="header-inner inner-block flex">
        <a href="<?php echo 'http://' . $_SERVER["HTTP_HOST"] ?>" class="logo-link flex">
            <img src="<?php echo 'http://' . $_SERVER["HTTP_HOST"] . "/images/logo.png" ?>" alt="logo" width="48" height="auto">
            <span>Solution</span>
        </a>
        <nav class="nav-div flex">
            <?php
            if (empty($user)) {
                echo "<a href='" . 'http://' . $_SERVER["HTTP_HOST"] . "/login' class='link color-white'>Авторизация</a><span class='vl'> | </span>";
                echo "<a href='" . 'http://' . $_SERVER["HTTP_HOST"] . "/register' class='link color-white'>Регистрация</a>";
            } else {
                echo "<a href='" . 'http://' . $_SERVER["HTTP_HOST"] . "' class='link color-white'>Главная</a><span class='vl'> | </span>";
                if ($user["status"]) {
                    echo "<a href='" . 'http://' . $_SERVER["HTTP_HOST"] . "/aplications?status=new' class='link color-white'>Заявки</a><span class='vl'> | </span>";
                    echo "<a href='" . 'http://' . $_SERVER["HTTP_HOST"] . "/category' class='link color-white'>Категории</a><span class='vl'> | </span>";
                }
                echo "<a href='" . 'http://' . $_SERVER["HTTP_HOST"] . "/profile' class='link color-white'>Мой кабинет</a><span class='vl'> | </span>";
                echo "<a href='" . 'http://' . $_SERVER["HTTP_HOST"] . "/logout' class='link color-white'>Выйти</a>";
            }
            ?>


        </nav>
    </div>
</header>

<body>
    <main class="main-page page-block">

        <?php include 'app/views/' . $content_view; ?>
    </main>
</body>
<!-- Скрипты -->
<script src="<?php echo 'http://' . $_SERVER["HTTP_HOST"] . '/js/aplications.js' ?>"></script>
<script src="<?php echo 'http://' . $_SERVER["HTTP_HOST"] . '/js/script.js' ?>"></script>
</html>