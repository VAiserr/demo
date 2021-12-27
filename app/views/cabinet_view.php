<div class="inner-block">
    <div class="flex sp">
        <h2>Мои заявки</h2>
        <nav class="filter flex f-center align-center">
            <span class="link selected">Все</span><span class="vl color-black">|</span>
            <span class="link">Новые</span><span class="vl color-black">|</span>
            <span class="link">Решенные</span><span class="vl color-black">|</span>
            <span class="link">Откланенные</span>
        </nav>
    </div>
    <hr>
</div>
<div class="inner-block">
    <ul class="applications-list flex f-center wrap">
        <?php 
            if (!empty($aplications)) {
                foreach ($aplications as $item) {
                    foreach($categories as $cat) {
                        if ($item["category_id"] == $cat["id"])
                            $category = $cat["category"];
                    }
                    printf('
                        <li class="application panel-block color-white">
                        <div class="panel-row flex f-center">
                            <h3>%s</h3>
                        </div>
                        <div class="panel-row flex">
                            <img src="%s" alt="" class="application-img">
                        </div>
                        <div class="panel-row flex sp">
                            <div class="word-wrap">
                                <h4>Категория: </h4><span> %s</span> 
                            </div>
                            <div class="flex">
                                <h4>Статус: </h4> <span class="%s">%s</span>
                            </div>
                        </div>
                        <div class="panel-row">
                        <div class="flex f-center">
                            <h3>Описание</h3>
                        </div>
                        <div class="word-wrap">
                            <p class="app-description">%s</p>
                        </div>
                        </div>
                        <div class="panel-row flex sp align-end">
                            <span class="date">%s</span>
                            <span class="link">Удалить</span>
                        </div>
                        </li>
                        ',
                        $item["title"],
                        "." . $item["image_before"],
                        $category,
                        $item["status_class"],
                        " " . $item["status"],
                        $item["description"],
                        $item["created_at"],
                        $item["status"] == "Решенная" ? '' : "Удалить"
                    );
                }
            } else {
                echo "<li class='application'><h3>Заявок нет<h3></li>";
            }
        ?>
        <!-- <li class="application panel-block color-white">
            <div class="panel-row flex f-center">
                <h3>Название заявки</h3>
            </div>
            <div class="panel-row flex">
                <img src="" alt="" class="application-img">
            </div>
            <div class="panel-row flex sp">
                <div class="word-wrap">
                    <h4>Категория: </h4> <span>text</span> 
                </div>
                <div class="flex">
                    <h4>Статус: </h4> <span class="selected">новая</span>
                </div>
            </div>
            <div class="panel-row flex f-center">
                <h3>Описание</h3>
            </div>
            <div class="panel-row">
                <p class="app-description">text</p>
            </div>
            <div class="panel-row flex sp align-end">
                <span class="date">25-10-2021 19:30</span>
                <span class="link">Удалить</span>
            </div>
        </li> -->

        
    </ul>
</div>
<div class="inner-block">
    <div class="flex f-center"><span class="link" id="show">Показать все</span></div>
    <hr>
</div>
<div class="inner-block flex f-center">
    <form enctype="multipart/form-data" action="/profile/add-aplication" class="addform form-block" method="POST">
        <div class="auth-header flex f-center align-center">
            <h3 class="title">Новая заявка</h3>
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
                // move_uploaded_file($_FILES["image"]["tmp_name"], "." . "/images/before/" . $_FILES["image"]["name"]);
                if (isset($application)) {
                    $app_title = $application["title"];
                    $description = $application["description"];
                    $email = $user["email"];
                }
                ?>
            </ul>
        </div>

        <div class="input-panel">
            <label for="title">Название</label><br>
            <input type="text" value="<?php echo $app_title ?? '' ?>" name="title" id="title" class="auth-input">
        </div>
        <div class="input-panel">
            <label for="login">Описание</label><br>
            <textarea class="auth-input" name="description" id="textarea" rows="5"><?php echo $description ?? '' ?></textarea>
        </div>
        <div class="input-panel">
            <label for="category">Категория</label><br>
            <select name="category" id="category" class="auth-input">
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
        <div class="input-panel">
            <label for="file">Фотография</label><br>
            <input type="file" name="image" id="image" class="auth-input">
        </div>

        <div class="input-panel">
            <input type="submit" value="Отправить" class="sub-btn">
        </div>
    </form>
</div>



<hr>