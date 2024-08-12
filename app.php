<?php

// подключение файлов логики
//TODO сформировать абсолютный путь
require_once 'src/main.function.php' ;
require_once 'src/template.function.php';
require_once 'src/log.function.php';
require_once 'src/game.function.php';

// вызов корневой функции
$result = main();

// вывод результата
echo $result; 
