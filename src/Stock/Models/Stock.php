<?php namespace Stock\Models;

use Stock\Contracts\Addable;
use Stock\Contracts\IGoods;
use Stock\Contracts\Takeable;

abstract class Stock implements Addable, Takeable
{
    protected $stock = [];

    /**
     * Add goods
     * @param IGoods $goods
     */
    public function add(IGoods $goods)
    {
        $this->stock[] = $goods;
    }

    public function add_many(array $goods = [])
    {
        foreach ($goods as $good) {
            $this->add($good);
        }
    }

    /**
     * Removes and Returns first element in stock
     * @return mixed
     */
    abstract public function take();
}
