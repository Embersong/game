<?php
const DS = DIRECTORY_SEPARATOR;
// подключение файлов логики
//TODO сформировать абсолютный путь
/*require_once __DIR__ . DS .'src/main.function.php' ;
require_once __DIR__ . '/src/template.function.php';
require_once __DIR__ . '/src/log.function.php';
require_once __DIR__ . '/src/game.function.php';*/

require_once __DIR__ . "/vendor/autoload.php";

// вызов корневой функции
$result = main('config.ini');

// вывод результата
echo $result;
