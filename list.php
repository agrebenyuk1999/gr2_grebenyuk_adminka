<?php
require "db.php";

$sql = "SELECT id, title FROM news";
$rows = $pdo->query($sql);
?>

<a href="addNews.php">Добавить новость</a>
<?php while ($news = $rows->fetch()) { ?>
    <ul>
        <li><a href="viewNews.php?id=<?php echo $news['id']; ?>"><?php echo $news['title']; ?></a></li>
    </ul>
<?php } ?>
