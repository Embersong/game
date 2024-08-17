<?php

function _log(mixed $data, string $suffix = ''): void
{
    if (is_array($data) || is_object($data)) $data = print_r($data, 1);

    $data = "### " . date("d.m.Y H:i:s") . ": " . $data;

    $fileHandler = @fopen(dirname(__DIR__) . '/storage/logs.txt' . $suffix, 'a');

    if (!$fileHandler) {
        echo handleError("Не могу открыть файл для логов");
        die();
    }

    fputs($fileHandler, $data . PHP_EOL);

    fclose($fileHandler);
}