<?php


function randFunction(array $config): string
{
    _log("Запуск игры угадай число");
    echo 'Привет, давай поиграем в игру угадай число!' . PHP_EOL;
    $name = readline("Как тебя зовут? ");
    echo "Привет, $name!" . PHP_EOL;

    for ($i = 0; $i < 2; $i++) {
        $correct = rand(1, 2);
        $question = "Угадай число от 1 до 2. ";

        $answer = readline("Вопрос: {$question}\nВаш ответ: ");

        if ($answer == $correct) {
            echo "Верно!" . PHP_EOL;
        } else {
            return handleError("'{$answer}' не правильный ответ. Правильный '{$correct}'.");

        }
    }

    return "Поздравляю, $name!" . PHP_EOL;
}

