-- Запрос для создания таблицы категорий --
create table if not exists `categories` (
    `id` int(10) unsigned not null auto_increment,
    `category` varchar(255) not null,
    primary key (id)
)
engine = innodb
auto_increment = 1
character set utf8
collate utf8_general_ci;

insert into `categories` (`category`) values
('default')