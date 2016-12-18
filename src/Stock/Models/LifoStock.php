<?php namespace Stock\Models;

use Stock\Contracts\Addable;
use Stock\Contracts\Takeable;

class LifoStock extends Stock implements Addable, Takeable
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
