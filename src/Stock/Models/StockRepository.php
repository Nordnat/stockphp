<?php
namespace Stock\Models;

use Stock\Core\Database\DBConnection;

// Zadanie tej klasy jest umieć stworzyć odpowiednie query statement i przekazać je do DBConnection
class StockRepository
{

    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }

    public function save(Stock $stock)
    {
        $statement = "INSERT INTO stocks (`name`, `type`) VALUES (:name, :type)";
        $args = [':name' => $stock->name, ':type' => $stock->type];
        $this->db->connect()->query($statement, $args); // powinno zwrócić ID dodanego elementu, a jak nie to trzeba to dopisać
        return $this->db->getLastId();
    }
}
