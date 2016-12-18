<?php namespace Stock\Models;

use Stock\Contracts\Addable;
use Stock\Contracts\Takeable;

class FifoStock extends Stock implements Addable, Takeable
{
    public function take()
    {
        return array_shift($this->stock);
    }
}
