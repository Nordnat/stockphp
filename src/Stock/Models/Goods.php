<?php namespace Stock\Models;

class Goods
{
    public $name;
    public $price;
    public $producer;
    public $quantity;
    public $serial_code;
    protected $validation_rulez = [
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

    public function __construct($data)
    {
        if (! $this->goodsValidation($data)) {
            // throw new \Exception needs "\" to exit namespace
            throw new \Exception("Goods attributes ar not valid");
        }

        $this->name = $data['name'];
        $this->price = $data['price'];
        $this->producer = $data['producer'];
        $this->quantity = $data['quantity'];
        $this->serial_code = $this->serialCodeGenerator($this->name);
    }

    protected function check_type($field, $type)
    {
        return $type === gettype($field);
    }

    protected function check_required($field, $required = false)
    {
        return $required ? isset($field) : true;
    }

    protected function goodsValidation($data)
    {
        foreach ($this->validation_rulez as $field => $rules) {
            foreach ($rules as $key => $rule) {
                // dynamically creates methods names based on goods attribute name
                $method = 'check_' . $key;
                $is_valid = $this->{$method}($data[$field], $rule);

                if ($is_valid === false) {
                    return false;
                }
            }
        }

        return true;
    }

    protected function serialCodeGenerator($name)
    {
        $name_substring = substr($this->name, 0, 3);
        $serial_code = $name_substring . round(microtime(true) * 1000);

        return $serial_code;
    }
}
