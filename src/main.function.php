<?php

function main(string $configFileAddress): string
{
    $config = readConfig($configFileAddress);

    if (!$config) {
        return handleError("Невозможно подключить файл настроек");
    }

    $functionName = parseCommand();

    _log($functionName);

    if (function_exists($functionName)) {
        $result = $functionName($config);
    } else {
        $result = handleError("Вызываемая функция не существует");
    }

    return $result;
}

function parseCommand(): string
{
    $functionName = 'helpFunction';

    _log($_SERVER['argv']);

    if (isset($_SERVER['argv'][1])) {
        $functionName = match ($_SERVER['argv'][1]) {
            'rand' => 'randFunction',
            'cars' => 'getCars',
            'posts' => 'getPosts',
            default => 'helpFunction'
        };
    }

    return $functionName;
}

function helpFunction(): string
{
    return handleHelp();
}

function readConfig(string $configAddress): array|false
{
    return parse_ini_file($configAddress, true);
}