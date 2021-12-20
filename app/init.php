<?php

// Подключаем файлы ядра
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';

// Подключение к базе данных
require_once 'database/db_connect.php';
require_once 'database/migration.php';

// Запускаем маршрутизатор
require_once 'routes.php'; 