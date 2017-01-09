<?php namespace Stock\Contracts;

interface Addable
{
    public function add(array $element = []);

    public function add_many(array $elements = []);
}
