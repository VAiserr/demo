<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo 'http://' . $_SERVER["HTTP_HOST"] . '/css/style.css' ?>">
    <script src="https://unpkg.com/vue@next"></script>
    <title>Авторизация</title>
</head>

<body>
    <section class="registration-page page-block">
        <div class="inner-block flex f-center">

            <form action="/login/submit" method="post" class="form-block">
                <div class="auth-header flex sp align-center">
                    <h3 class="title">Войти<span class="vl">/</span><a href="<?php echo 'http://' . $_SERVER["HTTP_HOST"] . '/register' ?>" class="link color-white">Регистрация</a></h3>
                    <a href="<?php echo 'http://' . $_SERVER["HTTP_HOST"] ?>" class="logo-link flex">
                        <img src="<?php echo 'http://' . $_SERVER["HTTP_HOST"] . "/images/logo.png" ?>" alt="logo" width="32" height="auto">
                        <span>Solution</span>
                    </a>
                </div>
                <hr>

                <div class="errors input-panel">
                    <ul>
                        <?php
                        if (!empty($errs)) {
                            foreach ($errs as $err) {
                                print '<li>' . $err . '</li>';
                            }
                        }
                        if (!empty($user)) {
                            $login = $user["login"];
                            $email = $user["email"];
                        }
                        ?>
                    </ul>
                </div>

                <div class="input-panel">
                    <label for="login">Введите логин или почту</label><br>
                    <div class="flex">
                        <input type="text" placeholder="Логин" value="<?php echo $login ?? '' ?>" name="login" id="login" class="auth-input width-anim">
                        <input type="email" placeholder="Почта" value="<?php echo $email ?? '' ?>" name="email" id="email" class="auth-input width-anim">
                    </div>
                </div>
                <!-- <div class="input-panel">
                    <label for="email">Почта</label><br>
                </div> -->
                <div class="input-panel">
                    <label for="password">Пароль</label><br>
                    <input type="password" name="password" id="password" class="auth-input">
                </div>

                <div class="input-panel">
                    <input type="submit" value="Войти" class="sub-btn">
                </div>
            </form>
        </div>
    </section>
    <script src="<?php echo 'http://' . $_SERVER["HTTP_HOST"] . "/js/login.js"; ?>"></script>
</body>

</html>