<?php namespace Classes;
use PDO;
class Db
{
    protected function getConfig()
    {
        $config = require('../../../config.php');
        return $config['db'];
    }
    protected function connect()
    {
        try {
            $hendler = new PDO('mysql:host='.$this->getConfig()["host"].';dbname='.$this->getConfig()["dbname"].'', ''.$this->getConfig()["dbuser"].'', ''.$this->getConfig()["dbpass"].'');
            $hendler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $hendler;
        } catch(\PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
    public function getQuery($queryContent) {
        $connection = $this->connect();
        $query = $connection->query($queryContent);

        while($r = $query->fetch()) {
            echo serialize($r);
        }
    }
}
