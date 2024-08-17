<?php
require_once __DIR__ . "/vendor/autoload.php";

$config = readConfig('config.ini');

$db = @dbConnect($config);

$title = "Заголовок 1";
$text = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, obcaecati?";

$result = pg_prepare($db, "insert", 'insert into posts (title, text) values ($1, $2);');

pg_send_execute($db, "insert", [$title, $text]);

//$result = pg_prepare($db, "select", 'SELECT * FROM posts WHERE id = $1');

//$result = pg_execute($db, "select", ['id' => 2]);

//print_r(pg_fetch_assoc($result));