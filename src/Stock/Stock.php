<?php namespace Stock;

class Stock
{
    protected $stock = [];
    public function add($partName) {
        array_push($this->stock, $partName);
    }
    public function take() {
        return array_shift($this->stock);
    }
}
