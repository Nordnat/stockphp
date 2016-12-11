<?php namespace Stock;

class Stock
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
    public function take()
    {
        return array_shift($this->stock);
    }
}
