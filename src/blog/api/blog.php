<?php
function apiPosts(): bool|string
{
    $db = @dbConnect(getConfig());


    $result = @pg_query($db, "select id, title, preview from public.\"Posts\";");

    //TODO проверка на ошибки и вывод json c текстом ошибки

    return json_encode(pg_fetch_all($result), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}

function apiPost(int $id)
{
    $db = @dbConnect(getConfig());

    @pg_prepare($db, "select", "select id, title, preview from public.\"Posts\" where id = $1;");

    $result = @pg_execute($db, "select", [$id]);

    //TODO проверка на ошибки и вывод json c текстом ошибки

    return json_encode(pg_fetch_assoc($result), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}