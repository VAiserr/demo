-- Запрос для создания таблицы пользователей --
create table if not exists `aplications` (
    `id` int(10) unsigned not null auto_increment,
    `title` varchar(255) not null,
    `description` varchar(255) not null,
    `user_id` int(10) not null,
    `category_id` int(10) not null,
    `image_before` varchar(255) not null,
    `image_after` varchar(255),
    `cause` varchar(255),
    `status` int(5) not null default 1,
    `created_at` timestamp default current_timestamp,
    `updated_at` timestamp on update current_timestamp,
    primary key (id)
)
engine = innodb
auto_increment = 1
character set utf8
collate utf8_general_ci;