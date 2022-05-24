<?php
/**
 * @var \App\Models\Article[] $news
 */
?>

<!DOCTYPE HTML>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <title>Последние новости</title>
</head>
<body style="margin: 0; padding: 0; border: 0">
<div style="display: grid; justify-content: center; margin: 100px">
    <div style="width: 600px">
        <form style="width: 600px; display: grid; gap: 10px" method="post" action="post.php">
            <label for="articleHead">
                Заголовок:
            </label>
            <input type="text" name="articleHead" style="width: 600px">
            <br>
            <label for="articleBody">Новость:</label>
            <textarea name="articleBody" rows="10" style="width: 600px"></textarea>
            <input type="submit" value="Создать" style="width: 150px; justify-self: right">
            <input type="hidden" name="scenario" value="newArticle">
        </form>

        <br>
        <hr style="width: 100%">

        <?php foreach ($news as $article) {?>
        <div style="display:grid; grid-template-columns: auto auto auto;">
            <span style="width: 350px"><?=$article->header?></span>
            <form style="justify-self: right" method="get" action="edit.php">
                <input type="submit" value="Редактировать" style="width: 150px;  margin: 0;">
                <input type="hidden" name="id" value="<?=sprintf("%'.03d", $article->id)?>">
            </form>
            <form style="justify-self: right" action="post.php" method="post">
                <input type="submit" value="Удалить" style="width: 100px; margin: 0;">
                <input type="hidden" name="articleId" value="<?=$article->id?>">
                <input type="hidden" name="scenario" value="deleteArticle">
            </form>
        </div>
        <hr>
        <?php } ?>
    </div>
</div>
</body>