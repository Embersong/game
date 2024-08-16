<?php
function getPosts(array $config): string
{
    $db = @dbConnect($config);
    if (!$db) {
        return handleError("Ошибка соединения с БД");
    }

    $result = pg_query($db, "select id, title from posts;");

    if (!$result) {
        return handleError("Ошибка запроса");
    }

    $arr = pg_fetch_all($result);

    return implode("\n", array_map(fn($item) => implode('| ', array_map(fn($value) => str_pad($value, 8), $item)), $arr));
}

function addPost(array $config): string
{

}