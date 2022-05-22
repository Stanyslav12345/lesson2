<?php


abstract class Model
{
    public int $id;

    protected static string $table = '';

    public static function findAll(): array
    {
        $db = new Db();
        return $db->query(
            'SELECT * FROM ' . static::$table,
            [],
            static::class
        );
    }

    public static function findById($id): Model | false
    {
        $db = new Db();
        return $db->query(
            //на тот странный случай, если id не уникален, ввожу лимит, чтобы в пустую не грузить базу
            'SELECT * FROM ' . static::$table . ' WHERE id=:id LIMIT 1',
            [':id'=>$id],
            static::class
        // если фетч вернул пустой массив, а с 8.0 он возвращает его вместо false, то заменяем нулевой индекс на false
        )[0] ?? false;
    }

}