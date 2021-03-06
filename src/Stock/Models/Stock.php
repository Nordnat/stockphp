<?php namespace Stock\Models;

use Stock\Contracts\Addable;
use Stock\Contracts\IGoods;
use Stock\Contracts\Takeable;
use Stock\Core\Database\DBConnection;

abstract class Stock implements Addable, Takeable
{
    const TYPE_FIFO = 'FIFO';
    const TYPE_LIFO = 'LIFO';
    const TYPE_UNDEFINED = 'UNDEFINED';

    public $name;
    public $created_at;
    public $type;
    public $goods = [];
    protected $repository;
    public $id;

    public function __construct()
    {
        $db = new DBConnection();
        $this->repository = new StockRepository($db);
    }

    /**
     * Saves element to database
     */
    public function save()
    {
        $this->id = $this->repository->save($this);
    }

    /**
     * Adds goods to stock
     *
     * @param IGoods $goods
     */
    public function add(IGoods $goods)
    {
        $this->goods[] = $goods;
    }

    /**
     * Adds multiple goods to stock
     *
     * @param array $goods
     */
    public function add_many(array $goods = [])
    {
        foreach ($goods as $good) {
            $this->add($good);
        }
    }

    /**
     * Removes and Returns first element in stock
     *
     * @return mixed
     */
    abstract public function take();
}
