<?php
//TODO добавить категории (и юзера)
//CRUD

$db = pg_connect("host=localhost port=5432 dbname=blog user=postgres password=zia9aayg");

$buttonText = "Добавить";
$action = "add";
$raw = [];

//UPDATE
if (isset($_GET['action']) && $_GET['action'] === 'edit') {
    $id = (int)$_GET['id'];
    $result = pg_prepare($db, "select", "select id, title, preview from public.\"Posts\" where id = $1 ;");

    $result = pg_execute($db, "select", [$id]);

    $raw = pg_fetch_assoc($result);

    $buttonText = "Править";
    $action = "save";
}

if (isset($_GET['action']) && $_GET['action'] === 'save') {
    $title = $_POST['title'];
    $text = $_POST['text'];
    $id = (int)$_POST['id'];

    pg_prepare($db, "update", "update public.\"Posts\" set title = $1, preview = $2 where id = $3 ;");
    pg_send_execute($db, "update", [$title, $text, $id]);

    header('Location: posts.php');
    exit;
}

//DELETE
if (isset($_GET['action']) && $_GET['action'] === 'delete') {

    $id = (int)$_GET['id'];
    $query = "DELETE FROM public.\"Posts\" WHERE id=$1";
    pg_prepare($db, "delete", $query);
    pg_send_execute($db, "delete", [$id]);

    header('Location: posts.php');
    exit;
}

//CREATE
if (isset($_GET['action']) && $_GET['action'] === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $text = $_POST['text'];

    pg_prepare($db, "insert", "insert into public.\"Posts\" (title, preview, text, category_id, user_id) values ($1, $2, '', 2, 1)   ;");

    pg_send_execute($db, "insert", [$title, $text]);

    header('Location: posts.php');
    exit;
}

//READ
$result = pg_query($db, "select id, title, preview from public.\"Posts\" ORDER BY id DESC ;");

$posts = pg_fetch_all($result);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD</title>
    <style>
        body {
            background-color: aqua;
        }
        div {
            border: 2px solid black;
            padding: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
   <h2>Посты</h2>
   <form method="post" action="?action=<?=$action?>">
       <input type="text" name="id" hidden value="<?=$raw['id'] ?? ''?>">
       <input type="text" name="title" placeholder="Заголовок поста" value="<?=$raw['title'] ?? ''?>"><br>
       <textarea name="text"  cols="30" rows="3" placeholder="Текст поста"><?=$raw['preview'] ?? ''?></textarea><br>
       <input type="submit" value="<?=$buttonText?>"><br>

   </form>
   <br>
   <?php foreach ($posts as $post): ?>
   <div>
       <h2><?=$post['title']?></h2>
       <p><?=$post['preview']?></p>
       <a href="?action=edit&id=<?=$post['id']?>">[правка]</a>
       <a href="?action=delete&id=<?=$post['id']?>">[X]</a>
   </div>
    <?php endforeach; ?>

</body>
</html>