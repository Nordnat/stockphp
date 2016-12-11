<?php namespace Stock;

class Stock
{
    protected $stock = [];
    public function add($partName) {
        if (is_array($partName)) {
            foreach ($partName as $part) {
                array_push($this->stock, $part);
            }
        } else {
            array_push($this->stock, $partName);
        }
    }
    public function take() {
        return array_shift($this->stock);
    }
}
