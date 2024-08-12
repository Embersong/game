<?php

function main(): string
{
    $functionName = parseCommand();

    _log($functionName);

    if (function_exists($functionName)) {
        $result = $functionName();
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
            default => 'helpFunction'
        };
    }

    return $functionName;
}

function helpFunction(): string
{
    return handleHelp();
}
