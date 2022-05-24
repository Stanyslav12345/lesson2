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
        $config = Config::getConfig();

        $host = $config->data['db']['host'];
        $dbName = $config->data['db']['dbname'];
        $user = $config->data['db']['user'];
        $password = $config->data['db']['password'];

        $this->dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbName, $user, $password);
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
        try {
            $result = $sth->execute($params);
        } catch (Exception) {
            $result = false;
        }

        return $result;
    }

    public function getLastId(): string
    {
        return $this->dbh->lastInsertId();
    }
}