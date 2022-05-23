<?php


namespace App;


use Exception;
use PDO;
use stdClass;

class Db
{
    protected PDO $dbh;

    public function __construct()
    {
        $config = (include __DIR__ . '/config.php')['db'];
        $this->dbh = new PDO(
            'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'],
            $config['user'],
            $config['password']
        );
    }

    public function query(string $sql, array $params = [], string $class = stdClass::class): array
    {
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
        } catch (Exception) {
            $result = false;
        }

        return $result;
    }
}