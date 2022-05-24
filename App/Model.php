<?php


namespace App;

abstract class Model
{
    public int $id;

    protected static string $table = '';

    public function update()
    {
        if (null === $this->id) {
            return;
        }

        $sets = [];
        $data = [];
        foreach (get_object_vars($this) as $prop => $value) {
            $data[':' . $prop] = $value;
            if ('id' == $prop) {
                continue;
            }
            $sets[] = $prop . '=:' . $prop;

        }

        $sql = 'UPDATE ' . static::$table . ' SET ' . implode(',', $sets) . ' WHERE id=:id';
        $db = new Db();
        $db->execute($sql, $data);
    }

    public function insert()
    {
        $columns = [];
        $data = [];
        foreach (get_object_vars($this) as $prop => $value) {
            if ('id' == $prop) {
                continue;
            }
            $data[':' . $prop] = $value;
            $columns[] = $prop;
        }

        $sql = 'INSERT INTO ' . static::$table . '(' . implode(',', $columns) . ') 
        VALUES (' . implode(',', array_keys($data)) . ')';

        $db = new Db();
        $db->execute($sql, $data);

        $this->id = $db->getLastId();
    }

    public function save()
    {
        if (!isset($this->id) || null === $this->id) {
            $this->insert();
        }

        $modelFromDb = static::findById($this->id);
        if (false === $modelFromDb) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    public function delete()
    {
        if (null === $this->id) {
            return;
        }

        $sql = 'DELETE FROM ' . static::$table . ' WHERE id=:id';
        $data[':id'] = $this->id;
        $db = new Db();
        $db->execute($sql, $data);
    }

    public static function findAll(): array
    {
        $db = new Db();
        return $db->query(
            'SELECT * FROM ' . static::$table,
            [],
            static::class
        );
    }

    public static function findById($id): Model|false
    {
        $db = new Db();
        return $db->query(
            //на тот странный случай, если id не уникален, ввожу лимит, чтобы в пустую не грузить базу
                'SELECT * FROM ' . static::$table . ' WHERE id=:id LIMIT 1',
                [':id' => $id],
                static::class
            // если фетч вернул пустой массив, а с 8.0 он возвращает его вместо false, то заменяем нулевой индекс на false
            )[0] ?? false;
    }

    public static function findLast(int $lastNum = 1): array
    {
        if ($lastNum < 1) {
            return [];
        }

        $db = new Db();
        return $db->query(
            'SELECT * FROM ' . static::$table . ' ORDER BY id DESC LIMIT ' . $lastNum,
            [],
            static::class);
    }
}