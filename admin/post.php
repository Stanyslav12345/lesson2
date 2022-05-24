<?php

use App\Models\Article;

require __DIR__ . '/../App/autoload.php';

function queryErr(){
    echo 'Ошбка запроса!';
    die;
}

$scenario = $_POST['scenario'] ?? null;

if ($scenario == null) {
    queryErr();
}

switch ($scenario) {
    case 'newArticle':
        $articleHead = $_POST['articleHead'] ?? null;
        $articleBody = $_POST['articleBody'] ?? null;

        if (in_array(null, [$articleHead, $articleBody], true)) {
            queryErr();
        }

        $newArticle = new Article();
        $newArticle->newsBody = $articleBody;
        $newArticle->header = $articleHead;
        $newArticle->createDate = date('Y-m-d H:i:s');
        $newArticle->save();
        break;

    case 'deleteArticle':
        $articleId = $_POST['articleId'] ?? null;

        if ($articleId == null){
            queryErr();
        }

        $article = Article::findById($articleId);

        if (false === $article){
            queryErr();
        }


        $article->delete();
        break;

    case 'editArticle':
        $articleId = $_POST['articleId'] ?? null;
        $articleHead = $_POST['articleHead'] ?? null;
        $articleBody = $_POST['articleBody'] ?? null;

        if (in_array(null, [$articleHead, $articleBody, $articleId], true)) {
            queryErr();
        }

        $article =  Article::findById($articleId);

        if (false === $article){
            queryErr();
        }

        $article->header = $articleHead;
        $article->newsBody = $articleBody;
        $article->save();
        break;

    default:
        queryErr();
}

header('Location: index.php');