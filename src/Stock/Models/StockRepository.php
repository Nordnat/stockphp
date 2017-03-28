<?php
namespace Stock\Models;

use Stock\Core\Database\DBConnection;

/**
 * This class makes proper query statement and pass DBConnection
 */
class StockRepository
{
    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    /**
     * @param Stock $stock
     * @return string
     */
    public function save(Stock $stock)
    {
        $statement = 'INSERT INTO stocks (`name`, `type`) VALUES (:name, :type)';
        $args = [':name' => $stock->name, ':type' => $stock->type];
        $this->db->connect()->query($statement, $args);

        return $this->db->getLastId();
    }
}
