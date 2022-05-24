<?php

require __DIR__ . '/../App/autoload.php';

$news = \App\Models\Article::findAll();

include __DIR__.'/../Templates/admin.php';