<?php
require_once __DIR__ . '/vendor/autoload.php';

//получаем параметры url, формат /api/{имя ресурса}/{id}
//запуск сервера через php -S localhost:80 http.php
//например /api/posts
//         /api/post/2
$url_array = explode("/", $_SERVER['REQUEST_URI']);

//Проверка входных параметров api на соответствие заданному маршруту и вывод подсказки пока просто текстом
if ($url_array[1] != 'api' || empty($url_array[2])) {
    echo 'Api entry point: /api/{resourse}/{id}';
    die();
}

//Получаем имя ресурса и id если есть
$action = $url_array[2];
$id = $url_array[3] ?? null;

//Получаем список маршрутов и извлекаем имя нужной функции
$routes = require "routes.php";
$functionName = $routes[$action];

if (function_exists($functionName)) {
    $result = isset($id) ? $functionName($id) : $functionName();
    echo $result;
} else {
    echo 'Нет такого ресурса';
}

