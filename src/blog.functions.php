<?php
function getPosts(array $config): string
{
    $db = @dbConnect($config);


    $result = @pg_query($db, "select id, title from posts;");

    if (!$result) {
        return handleError("Ошибка запроса "  . pg_last_error($db));
    }

    $arr = pg_fetch_all($result);

    return implode("\n", array_map(fn($item) => implode('| ', array_map(fn($value) => str_pad($value, 8), $item)), $arr));
}

function addPost(array $config): string
{

}