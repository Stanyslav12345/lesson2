<?php

require __DIR__ . '/../App/autoload.php';

$articleId = $_GET['id'] ?? null;

if (null === $articleId){
    echo 'Новость не найдена';
    die;
}

$article = \App\Models\Article::findById($articleId);
if (null === $article){
    echo 'Новость не найдена';
    die;
}

include __DIR__.'/../Templates/articleEdit.php';
