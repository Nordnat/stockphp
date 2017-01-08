<?php namespace Stock\Models;

class Part
{
    protected $partId;
    protected $partName;
    protected $partPrice;
    protected $partProducer;

    public function __construct ( $pId, $pName, $pPrice, $pProducer ) {
        if(filter_var($pId, FILTER_VALIDATE_INT) === false) {
            throw new \InvalidArgumentException('ID accepts only integers. Input was: '.gettype($pId));
        }
        else {
            $this->partId = $pId;
        }
        if(is_string($pName) === false) {
            throw new \InvalidArgumentException('Only accepts strings. Input was: '.gettype($pName));
        }
        else {
            $this->partName = $pName;
        }
        if(filter_var($pPrice, FILTER_VALIDATE_INT) === false) {
            throw new \InvalidArgumentException('Only accepts integers. Input was: '.gettype($pPrice));
        }
        else {
            $this->partPrice = $pPrice;
        }
        if(is_string($pProducer) === false) {
            throw new \InvalidArgumentException('Only accepts strings. Input was: '.gettype($pProducer));
        }
        else {
            $this->partProducer = $pProducer;
        }
    }
}
