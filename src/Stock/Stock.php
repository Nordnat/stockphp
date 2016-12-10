<?php namespace Stock;

class Stock
{
    protected $stock = [];
    public function add($arr, $partName) {
        array_push($arr, $partName);
    }
    public function take ($arr) {
        return array_shift($arr);
    }
}
