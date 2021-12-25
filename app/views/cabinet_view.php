<h1>Личный кабинет</h1>

<h3>Мои заявки</h3>
<ul>
    <?php
        print_r($data);
        
    ?>
    <form action="/profile/change-aplication" method="GET">
        <input type="text" name="id">
        <input type="text" name="title" value="lox" hidden>
        <input type="submit" value="OK">
    </form>
    <?php if (isset($_GET)) print_r($_GET) ?>
</ul>

<h3>Новая заявка</h3>
<hr>
<ul>
    <?php
        if (isset($errs)) {
            foreach ($errs as $err) {
                echo "<li>$err</li>";
            }
        }
    ?>
</ul>
<form action="/profile/add" method="POST">
    <label for="title">Название</label>
    <input type="text" name="title" id="title"><br>

    <label for="description">Описание</label>
    <input type="text" name="description" id="description"><br>

    <label for="name">категория</label>
    <select name="category" id="category">
        <option value="" hidden selected>выбирите категорию</option>
        <?php
        foreach ($categories as $key => $value) {
            $id = $value["0"];
            $category = $value["1"];
            echo "<option value='$id'>$category</option>";
        }
        ?>
    </select><br>
    <input type="submit" value="Добавить заявку">
</form>