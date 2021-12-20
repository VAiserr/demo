<h1>Регистрация</h1>
<div class="errors">
    <?php
    print_r($data);
    ?>
</div>
<form action="/register/submit" method="post">
    <label for="login">Логин</label>
    <input type="text" name="login">
    <label for="password">Пароль</label>
    <input type="password" name="password" id="">
    <br>
    <input type="submit" value="Регистрация">
</form>