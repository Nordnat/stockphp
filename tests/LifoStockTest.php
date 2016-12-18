<?php
use PHPUnit\Framework\TestCase;
use Stock\Models\LifoStock;

class LifoStockTest extends TestCase
{
    public $stock;

    public function setUp()
    {
        $this->stock = new LifoStock();
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
        $this->assertEquals(0, count($stock_array));
        $this->assertEquals($taken_element, $element);
    }

    public function testAddMethodIfAcceptingArrays()
    {
        $element1 = ['brakes', 'wheel'];
        $this->stock->add($element1);

        $class = new ReflectionClass($this->stock);

        $property = $class->getProperty('stock');
        $property->setAccessible(true);
        $stock_array = $property->getValue($this->stock);
        $this->assertEquals($stock_array[0], 'brakes');
        $this->assertEquals($stock_array[1], 'wheel');
        $this->assertEquals(2, count($stock_array));
    }
}
