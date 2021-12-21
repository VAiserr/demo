<h1>Регистрация</h1>
<div class="errors">
    <ul>
        <?php
            if (!empty($errs)) {
                foreach ($errs as $err) {
                    print '<li>' . $err . '</li>';
                }
            }
        ?>
    </ul>
</div>
<?php 
    if (isset($data)) {
        $name = $data["FIO"];
        $login = $data["login"];
        $email = $data["email"];
    }
?>
<form action="/register/submit" method="post">
    <label for="FIO">ФИО</label>
    <input value="<?php echo $name ?? '' ?>" type="text" name="FIO" id="FIO">
    <label for="login">Логин</label>
    <input value="<?php echo $login ?? '' ?>" type="text" name="login" id="login">
    <label for="email">Почта</label>
    <input value="<?php echo $email ?? '' ?>" type="email" name="email" id="email">
    <label for="password">Пароль</label>
    <input type="password" name="password" id="password">
    <br>
    <input type="submit" value="Регистрация">
</form>