-- Запрос для создания таблицы пользователей --
create table if not exists `users` (
    `id` int(10) unsigned not null auto_increment,
    `FIO` varchar(255) not null,
    `login` varchar(255) not null,
    `email` varchar(255) not null,
    `password` varchar(255) not null,
    `status` boolean not null default 0,
    primary key (id)
)
engine = innodb
auto_increment = 1
character set utf8
collate utf8_general_ci;

-- Учетная запись администратора --
insert into `users` (`FIO`, `login`, `email`, `password`, `status`) values
    ('В.В.Путин', 'admin', 'yourDuddy@mail.ru', '12345678', 1)