<?php

use App\Models\Article;

require __DIR__ . '/App/autoload.php';

$lastNews = Article::findLast(3);
include __DIR__ . '/Templates/news.php';

