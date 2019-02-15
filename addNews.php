<?php
require "db.php";
require "formValidate.php";

$sql = "SELECT id, name FROM categories";
$rows = $pdo->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($errors) == 0) {
    $title = trim($_POST['title']);
    $datePublish = date('Y-m-d', strtotime($_POST['datePublish']));
    $isPublish = $_POST['isPublish'];
    $category = $_POST['category'];
    $content = trim($_POST['content']);
    $author = trim($_POST['author']);

    $values = ['title'=>$title, 'date_publish'=>$datePublish, 'status'=>$isPublish, 'category_id'=>$category,
                'content'=>$content, 'author'=>$author];
    $sql = "INSERT INTO news SET title=:title,date_publish=:date_publish,status=:status,category_id=:category_id, 
             content=:content,author=:author";
    $stm = $pdo->prepare($sql);
    $stm->execute($values);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post">
    Название новости:
    <div><input type="text" name="title"></div>
    <div style="color: red;"> <?php echo ($errors['title'] ? $errors['title'][0] : ''); ?></div>
    Дата публикации:
    <div><input type="date" name="datePublish"></div>
    <div style="color: red;"> <?php echo ($errors['datePublish'] ? $errors['datePublish'][0] : ''); ?></div>
    Статус:
    <div>
        <label>Опубликовать <input type="radio" name="isPublish" value="published"></label>
        <label>Черновик <input type="radio" name="isPublish" value="draft" checked></label>
    </div>
    Категория:
    <div>
        <select name="category">
            <?php while ($nameCat = $rows->fetch()) { ?>
                <option value="<?php echo $nameCat['id'] ?>"><?php echo $nameCat['name'] ?></option>
            <?php } ?>
        </select>
    </div>
    Текст новости:
    <div><textarea name="content"></textarea></div>
    <div style="color: red;"> <?php echo ($errors['content'] ? $errors['content'][0] : ''); ?></div>
    Автор:
    <div><input type="text" name="author"></div>
    <div style="color: red;"> <?php echo ($errors['author'] ? $errors['author'][0] : ''); ?></div>
    <div><button type="submit">Готово</button></div>
    <a href="list.php">К списку новостей</a>
</form>
</body>
</html>
