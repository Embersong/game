<?php

//вывод сообщения об ошибке красным
function handleError(string $errorText): string
{
    return "\033[31m" . $errorText . " \r\n \033[97m";
}

function handleHelp(): string
{
    $help = "Программа работы с файловым хранилищем" . PHP_EOL;
    $help .= "Порядок вызова" . PHP_EOL;
    $help .= "php app.php [COMMAND]" . PHP_EOL;
    $help .= "Доступные команды:" . PHP_EOL;
    $help .= "rand - игра, \"Угадай число\"" . PHP_EOL;
    $help .= "posts - список всех постов" . PHP_EOL;
    $help .= "addpost - добавить пост" . PHP_EOL;
    $help .= "help - помощь" . PHP_EOL;

    return $help;
}