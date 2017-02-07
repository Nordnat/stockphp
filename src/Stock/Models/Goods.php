<?php namespace Stock\Models;

use Stock\Contracts\IGoods;

class Goods implements IGoods
{
    public $name;
    public $price;
    public $producer;
    public $quantity;
    public $serial_code;
    protected $validation_rules = [
        'name' => [
            'type' => 'string',
            'required' => true
        ],
        'price' => [
            'type' => 'double',
            'required' => true
        ],
        'producer' => [
            'type' => 'string',
            'required' => true
        ],
        'quantity' => [
            'type' => 'integer',
            'required' => true
        ]
    ];

    public function __construct($data = null)
    {
        if ($data !== null && ! $this->goodsValidation($data)) {
            // throw new \Exception needs "\" to exit namespace
            throw new \Exception("Goods attributes ar not valid");
        }

        if ($data !== null) {
            $this->setAttributes($data);
        }

        $this->serial_code = $this->serialCodeGenerator($this->name);
    }

    protected function setAttributes($data)
    {
        $this->name = $data['name'];
        $this->price = $data['price'];
        $this->producer = $data['producer'];
        $this->quantity = $data['quantity'];
    }

    protected function check_type($field, $type)
    {
        return gettype($field) === $type;
    }

    protected function check_required($field, $required = false)
    {
        return $required ? isset($field) : true;
    }

    protected function goodsValidation($data)
    {
        foreach ($this->validation_rules as $field => $rules) {
            foreach ($rules as $key => $rule) {
                // dynamically creates methods names based on goods attribute name
                $method = 'check_' . $key;
                $d = array_key_exists($field, $data) ? $data[$field] : null;
                $is_valid = $this->{$method}($d, $rule);

                if ($is_valid === false) {
                    return false;
                }
            }
        }

        return true;
    }

    protected function serialCodeGenerator()
    {
        $name_substring = isset($this->name) ? substr($this->name, 0, 3) : 'std';
        $serial_code = $name_substring . round(microtime(true) * 1000);

        return $serial_code;
    }
}
