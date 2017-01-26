<?php namespace Stock\Contracts;

interface Addable
{
    public function add(IGoods $goods);

    public function add_many(array $goods = []);
}
