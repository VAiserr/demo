
<div class="inner-block">
    <div class="flex f-center"><h2>Последние решенные заявки</h2></div>
    <hr>
</div>

<div class="inner-block">
    <ul class="applications-list flex f-center wrap">
        <?php 
            if (!empty($aplications)) {
                for ($i = 0; $i < 4 && $item = @$aplications[$i]; $i++) {
                    $image_before = "http://" . $_SERVER["HTTP_HOST"] . $item["image_before"];
                    $image_after = "http://" . $_SERVER["HTTP_HOST"] . $item["image_after"];
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
                            <img src="%s" alt="" class="application-img" id="img-before" onmouseover="switchImg(event)">
                            <img src="%s" alt="" class="application-img" id="img-after" onmouseout="switchImg(event)" hidden>
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
                        </div>
                        </li>
                        ',
                        $item["title"],
                        $image_before,
                        $image_after,
                        $category,
                        $item["status_class"],
                        " " . $item["status"],
                        $item["description"],
                        $item["updated_at"]
                    );
                }
            } else {
                echo "<li class='application'><h3>Заявок нет<h3></li>";
            }
        ?>        
    </ul>
</div>