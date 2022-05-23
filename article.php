<?php

use App\Models\Article;

require __DIR__ . '/App/autoload.php';

$articleId = $_GET['id'] ?? null;

//если нет id, то редиректим на главную страницу
if ($articleId === null) {
    header('Location: index.php');
    die;
}

$article = Article::findById($articleId);

include __DIR__ . '/Templates/article.php';


