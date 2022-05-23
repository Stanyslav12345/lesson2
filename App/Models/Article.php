<?php


namespace App\Models;

use App\Model;

class Article extends Model
{
    public string $header;
    public string $newsBody;
    public string $createDate;

    protected static string $table = 'articles';

}