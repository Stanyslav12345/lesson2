<?php

require_once __DIR__.'/App/Db.php';
require_once  __DIR__.'/App/Model.php';
require_once  __DIR__.'/App/Article.php';

$lastNews = Article::getLast(3);
include __DIR__.'/Templates/news.php';

