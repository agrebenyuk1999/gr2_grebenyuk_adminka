<?php
require "db.php";

$id = $_GET['id'];

$sql = "SELECT news.title, news.date_publish, news.content, news.author, categories.name AS category 
        FROM news 
        JOIN categories ON news.category_id = categories.id 
        WHERE news.id = :id";
$rows = $pdo->prepare($sql);
$rows->execute(['id' => $id]);
$news = $rows->fetch();
?>

<h1><?php echo $news['title']; ?></h1>
<div>Автор: <?php echo $news['author'] ?></div>
<div>Категория: <?php echo $news['category'] ?></div>
<div>Дата публикации: <?php echo $news['date_publish'] ?></div>
<p><?php echo $news['content'] ?></p>

<a href="list.php">К списку новостей</a>
