<h1>Авторизация</h1>
<ul>
    <?php
    if (isset($errs)) {
        foreach ($errs as $err) {
            echo "<li>" . $err . "</li>";
        }
    }
    if (isset($data)) {
        $login = $data["login"];
        $email = $data["email"];
    }
    ?>
</ul>
<form action="/login/submit" method="POST">
    <label for="login">Введите логин</label>
    <input value="<?php echo $login ?? '' ?>" type="text" name="login">
    <label for="email">или почту</label>
    <input value="<?php echo $email ?? '' ?>" type="email" name="email" id="email"><br>
    <label for="password">Пароль</label>
    <input type="password" name="password" id="password">
    <br>
    <input type="submit" value="Зайти">
</form>