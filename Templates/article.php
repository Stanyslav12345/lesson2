<?php
/**
 * @var App\Models\Article|false $article
 */
?>

<!DOCTYPE HTML>
<html lang='ru'>
<head>
    <meta charset='utf-8'>
    <title>Последние новости</title>
</head>
<body>
<div style="justify-content: center; display: grid">

    <?php
    if (!($article)) { ?>
        <div style="display: grid; justify-content: center">
            <span style="margin: 100px; padding: 10px; background-color: antiquewhite; border-radius: 10px">
                Новость не найдена!
            </span>
        </div>';

        <?php
        die;
    }


    ?>
    <div style="width: 700px; background-color: #f1f1f1; border-radius: 20px; padding: 10px; margin: 20px">
        <h2><?= $article->header ?></h2>
        <div><?= $article->newsBody ?></div>
    </div>
</div>
</body>