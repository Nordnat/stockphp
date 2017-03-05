<?php

namespace Core;

use Stock\Core\Config\DBConfig;

class DBConnection
{
    /**
     * @var mixed $db_config
     */
    protected $db_config;

    /**
     * @var \PDO $handler;
     */
    protected $handler;

    /**
     * @var \PDOStatement $statement
     */
    protected $statement;

    /**
     * DBConnection constructor.
     */
    public function __construct()
    {
        $this->db_config = (object) DBConfig::get();
        $this->connect();
    }

    /**
     * @return static
     */
    public function connect()
    {
        if (! $this->handler) {
            $this->handler = new \PDO($this->buildConnectionString(),
                                      $this->db_config->username,
                                      $this->db_config->password);
        }

        return $this;
    }

    /**
     * @param string $statement
     * @return static
     */
    public function rawQuery($statement)
    {
        $this->statement = $this->handler->query($statement);

        return $this;
    }

    /**
     * @return mixed
     */
    public function fetch()
    {
        return $this->statement->fetch();
    }

    /**
     * @return array
     */
    public function fetchAll()
    {
        return $this->statement->fetchAll();
    }

    /**
     * @return string
     */
    public function fetchColumn()
    {
        return $this->statement->fetchColumn();
    }

    /**
     * @param string $statement statement
     * @param array $args input_args
     * @param array $driver_options
     * @return static
     */
    public function query($statement, array $args = [], array $driver_options = [])
    {
        $this->statement = $this->handler->prepare($statement, $driver_options);
        $this->statement->execute($args);

        return $this;
    }

    /**
     * @return string
     */
    protected function buildConnectionString()
    {
        $str = $this->db_config->driver;
        $str .= ':host=' . $this->db_config->host;
        $str .= ';port=' . $this->db_config->port;
        $str .= ';dbname=' . $this->db_config->database;
        $str .= ';charset=' . $this->db_config->charset;

        return $str;
    }
}
