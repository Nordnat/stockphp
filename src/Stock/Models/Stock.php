<?php namespace Stock\Models;

use Stock\Contracts\Addable;
use Stock\Contracts\Takeable;

abstract class Stock implements Addable, Takeable
{
    protected $stock = [];
    protected $required_keys = ['name', 'price', 'producent'];

    /**
     * Add elements to stock
     * @param $elements string|array Element or array of Elements
     */
    public function add(array $element = [])
    {

        if ($this->validate($element)) {
            $this->stock[] = $element;
        }
    }

    public function add_many(array $elements = [])
    {
        foreach ($elements as $element) {
            $this->add($element);
        }
    }

    /**
     * Removes and Returns first element in stock
     * @return mixed
     */
    abstract public function take();

    protected function validate($element)
    {
        $is_valid = true; // domniemanie niewinnosci ;)

        foreach ($this->required_keys as $required) {
            // wykonaj minimym jedno sprawdzenie czy klucz istnieje
            $is_valid = array_key_exists($required, $element); // nadpisz wynik sprawdzenia

            if ($is_valid === false) {
                // jesli klucz nie istnieje przerwij dalsze sprawdzanie
                // w tym momencie $is_valid jest ustawione na false
                break;
            }

            // jesli wszystko jest ok to $is_valid pozostaje zawsze true
        }

        // zwroc true albo false
        return $is_valid;
    }
}
