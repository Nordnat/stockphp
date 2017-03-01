<?php namespace Stock\Models;

use Stock\Contracts\Addable;
use Stock\Contracts\Takeable;

class FifoStock extends Stock implements Addable, Takeable
{
    /**
     * Removes and Returns first element in stock
     *
     * @return mixed
     */
    public function take()
    {
        return array_shift($this->goods);
    }
}
