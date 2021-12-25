<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<header>
    <div class="flex header-box">
        <div class="logo-box">
            <img src="" alt="" class="logo">
        </div>
        <div class="flex nav-block">
            <nav class="flex navigation"></nav>
            <div class="user">
                <?php
                if (isset($user)) {
                    echo "<a href='/logout'><h3>Добро пожаловать " . $name . "</h3></a>";
                } else {
                    echo "
                        <div class=''>
                            <a href='/login'>Войти</a> <br> <a href='/register'>Зарегистрироваться</a>
                        </div>
                    ";
                }

                ?>
            </div>
        </div>
    </div>
</header>

<body>
    <?php include 'app/views/' . $content_view; ?>
</body>

</html>