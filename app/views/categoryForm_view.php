<div class="inner-block application-list flex f-center wrap">
    <form method="POST" action="/category/add" class="application panel-block color-white">
        <div class="auth-header flex f-center align-center">
            <h2>Добавить категорию</h2>
        </div>

        <div class="errors panel-row">
            <hr><ul>
                <?php
                if (!empty($add_errs)) {
                    foreach ($add_errs as $err) {
                        print '<li>' . $err . '</li>';
                    }
                }
                if (!empty($_POST["category"])) {
                    $curr_category = $_POST["category"];
                }
                ?>
            </ul>
        </div>
        <div class="panel-row">
            <label for="category-add">Категория</label><br>
            <input type="text" name="category-add" id="category-add" value="<?php echo @$curr_category ?>" class="auth-input">
        </div>
        <div class="panel-row"></div>
        <div class="panel-row">
            <input type="submit" value="Добавить" class="sub-btn auth-input">
        </div>
    </form>

    <form method="POST" action="category/delete" class="application panel-block color-white">
        <div class="auth-header flex f-center align-center">
            <h2>Удалить категорию</h2>
        </div>

        <div class="errors panel-row">
            <hr><ul>
                <?php
                if (!empty($del_errs)) {
                    foreach ($del_errs as $err) {
                        print '<li>' . $err . '</li>';
                    }
                }
                ?>
            </ul>
        </div>
        <div class="panel-row">
            <label for="category-del">Категория</label><br>
            <select name="category-del" id="category-del" class="auth-input">
            <option value="" hidden selected>выбирите категорию</option>
                <?php
                foreach ($categories as $value) {
                    $id = $value["id"];
                    $category = $value["category"];
                    echo "<option value='$id'>$category</option>";
                }
                ?>
            </select>
        </div>
        <div class="panel-row"></div>
        <div class="panel-row">
            <input type="submit" value="Удалить" class="sub-btn auth-input">
        </div>
    </form>
</div>