<?php namespace Stock;

class LifoStock extends Stock
{
    /**
     * Removes and Returns last element in stock
     * @return mixed
     */
    public function take()
    {
        return array_pop($this->stock);
    }
}
