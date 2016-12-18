<?php namespace Stock\Models;

use Stock\Contracts\Addable;
use Stock\Contracts\Takeable;

abstract class Stock implements Addable, Takeable
{
    protected $stock = [];

    /**
     * Add elements to stock
     * @param $elements string|array Element or array of Elements
     */
    public function add($elements)
    {
        $this->stock = array_merge($this->stock, (array) $elements);
    }

    /**
     * Removes and Returns first element in stock
     * @return mixed
     */
    abstract public function take();
}
