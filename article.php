<?php

$articleId =  $_GET['id'] ?? null;

//если нет id, то редиректим на главную страницу
if ($articleId === null){
    header('Location: index.php');
    die;
}

require_once __DIR__.'/App/Db.php';
require_once  __DIR__.'/App/Model.php';
require_once  __DIR__.'/App/Article.php';

// если новость не найдена, то говорим, что новость не найдена
if (!($article = Article::findById($articleId))){ ?>
<div style="display: grid; justify-content: center">
    <span style="margin: 100px; padding: 10px; background-color: antiquewhite; border-radius: 10px">
        Новость не найдена!
    </span>
</div>';

<?php
    die;
} ?>

<div style="width: 700px; background-color: #f1f1f1; border-radius: 20px; padding: 10px; margin: 20px">
    <h2><a href="article.php?id=<?=$article->id?>" style="text-decoration: none; color: black"><?=$article->header?></a></h2>
<div><?=$article->newsBody?></div>
</div>
