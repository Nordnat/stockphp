<?php
use PHPUnit\Framework\TestCase;
use Stock\Stock;

class StockTest extends TestCase
{
    public $stock;

    public function setUp()
    {
        $this->stock = new Stock();
    }
    public function testAdd()
    {
        $element = 'silnik';
        $this->stock->add($element);

        $class = new ReflectionClass($this->stock);

        $property = $class->getProperty('stock');
        $property->setAccessible(true);
        $stock_array = $property->getValue($this->stock);
        $this->assertEquals($element, $stock_array[0]);
    }
    public function testTake()
    {
        $element = 'silnik';
        $this->stock->add($element);
        $taken_element = $this->stock->take();

        $class = new ReflectionClass($this->stock);

        $property = $class->getProperty('stock');
        $property->setAccessible(true);
        $stock_array = $property->getValue($this->stock);
        $this->assertEquals(0,count($stock_array));
        $this->assertEquals($taken_element, 'silnik');
    }
}
