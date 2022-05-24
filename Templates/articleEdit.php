<?php
/**
 * @var \App\Models\Article $article
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
            <input type="text" name="articleHead" style="width: 600px" value="<?=$article->header?>">
            <br>
            <label for="articleBody">Новость:</label>
            <textarea name="articleBody" rows="10" style="width: 600px"><?=$article->newsBody?></textarea>
            <input type="submit" value="Редактировать" style="width: 150px; justify-self: right">
            <input type="hidden" name="scenario" value="editArticle">
            <input type="hidden" name="articleId" value="<?=$article->id?>">
        </form>
    </div>
</div>

</body>