
<div class="inner-block">
    <div class="flex f-center"><h2>Последние решенные заявки</h2></div>
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