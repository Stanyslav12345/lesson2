<?php
/**
 * @var \App\Models\Article[] $lastNews
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
    foreach ($lastNews as $article) { ?>
        <div style="width: 700px; background-color: #f1f1f1; border-radius: 20px; padding: 10px; margin: 20px">
            <h2><a href="article.php?id=<?= sprintf("%'.03d\n", $article->id) ?>"
                   style="text-decoration: none; color: black"><?= $article->header ?></a></h2>
            <div><?= $article->newsBody ?></div>
        </div>
    <?php } ?>

</div>
</body>