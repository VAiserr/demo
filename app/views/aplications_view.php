
<div class="inner-block">
    <div class="flex sp">
        <h2>Заявки</h2>
        <nav class="filter flex f-center align-center">
            <a href="/aplications" class="color-black link <?php if(empty($_GET["status"])) echo "selected"; ?>">Все</a><span class="vl color-black">|</span>
            <a href="/aplications?status=new" class="color-black link <?php echo @$_GET["status"] == "new" ? "selected" : ""; ?>">Новые</a><span class="vl color-black">|</span>
            <a href="/aplications?status=decided" class="color-black link <?php echo @$_GET["status"] == "decided" ? "selected" : ""; ?>">Решенные</a><span class="vl color-black">|</span>
            <a href="/aplications?status=declined" class="color-black link <?php echo @$_GET["status"] == "declined" ? "selected" : ""; ?>">Откланенные</a>
        </nav>
    </div>
    <hr>
</div>

<div class="inner-block">
<ul class="applications-list flex f-center wrap">
        <?php 
            if (!empty($aps)) {
                foreach ($aps as $item) {
                    foreach($categories as $cat) {
                        if ($item["category_id"] == $cat["id"])
                            $category = $cat["category"];
                    }
                    $input = $item["status"] == "Новая" ?
                    '<div class="panel-row">
                    <label for="action">Действие</label><br>
                    <select onchange="generateForm(event)" class="auth-input" id="'. $item["id"] .'">
                    <option value="" hidden selected>выбирите действие</option>
                        <option value="2">Решить</option>
                        <option value="3">Откланить</option>
                    </select>
                    </div>
                    <div class="" id="apl-'. $item["id"] .'"></div>' : '';
                    print '
                        <li class="application panel-block color-white">
                        <div class="panel-row flex f-center">
                            <h3>' . $item["title"] . '</h3>
                        </div>
                        <div class="panel-row flex">
                            <img src=".' . $item["image_before"] . '" alt="" class="application-img">
                        </div>
                        <div class="panel-row flex sp">
                            <div class="word-wrap">
                                <h4>Категория: </h4><span>'. $category .'</span> 
                            </div>
                            <div class="flex">
                                <h4>Статус: </h4> <span class="'. $item["status_class"] .'"> ' . $item["status"] .'</span>
                            </div>
                        </div>
                        <div class="panel-row">
                        <div class="flex f-center">
                            <h3>Описание</h3>
                        </div>
                        <div class="word-wrap">
                            <p class="app-description">'. $item["description"] .'</p>
                        </div>
                        </div>'. $input
                        .'<div class="panel-row flex sp align-end">
                            <span class="date">'. $item["created_at"] .'</span>
                            <span class="link">Удалить</span>
                        </div>
                        </li>';
                }
            } else {
                echo "<li class='application'><h3>Заявок нет<h3></li>";
            }
        ?>  
        
        
    </ul>
</div>