<?php


class Db
{
    protected PDO $dbh;

    public function __construct()
    {
        $this->dbh = new PDO('mysql:host=localhost;dbname=php2lesson1', 'php2user', '123');
    }

    public function query(string $sql, array $params = [], string $class = stdClass::class): array
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);

        return $sth->fetchAll(PDO::FETCH_CLASS, $class);
    }


    //тут загвоздка, в том что лимит требует исключительно int, без кавычек, а PDO все оборачивает в них,
    //а метод execute не предусматривает ручную типизацию
    //и bindParam не хочет дружить вместе с параметрами в execute, поэтому надо либо мудрить цикл с bindParam,
    //либо поступить, как я поступил, надеюсь это достаточно законно
    public function queryLim(string $sql, array $params = [], string $class = stdClass::class, int $limit = 1, int $offset = 0): array
    {
        // поскольку ничего кроме int не может прийти на переменные,
        // я могу легально дополнить конец запроса такой строкой
        // на всякий случай буежусь, что числа не отрицательные
        $limit = abs($limit);
        $offset = abs($offset);
        $sql .= ' LIMIT ' . $limit . ' OFFSET ' . $offset;

        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);

        return $sth->fetchAll(PDO::FETCH_CLASS, $class);
    }

    public function execute(string $query, $params = []): bool
    {
        $sth = $this->dbh->prepare($query);
        //execute по документам в случае ошибки должен возвращать fasle, но возвращает ошибку,
        //поэтому пришлось городить try-catch
        try {
            $result = $sth->execute($params);
        } catch (Exception){
            $result = false;
        }

        return $result;
    }
}