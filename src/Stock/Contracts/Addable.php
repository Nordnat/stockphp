<?php namespace Stock\Contracts;

use Stock\Models\Goods;

interface Addable
{
    public function add(Goods $goods);

    public function add_many(array $goods = []);
}
