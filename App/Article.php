<?php


class Article extends Model
{
    public string $header;
    public string $newsBody;
    public string $createDate;

    protected static string $table = 'articles';

    public static function getLast(int $lastNum): array
    {
        $db = new Db();
        return $db->queryLim(
            'SELECT * FROM ' . static::$table . ' ORDER BY createDate DESC',
            [],
            Article::class,
            $lastNum
        );
    }


}