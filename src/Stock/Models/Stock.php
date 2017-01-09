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
    public function add(array $element = [])
    {
        if (count($element) == 3) {
            $this->stock[] = $element;
        }
    }

    public function add_many(array $elements = [])
    {
        foreach ($elements as $element) {
            $this->add($element);
        }
    }

    /**
     * Removes and Returns first element in stock
     * @return mixed
     */
    abstract public function take();
}
