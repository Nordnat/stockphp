<?php
use PHPUnit\Framework\TestCase;
use Stock\Models\Stock;

class TestProxyStock extends Stock
{
    /**
     * Removes and Returns first element in stock
     * @return mixed
     */
    public function take()
    {
        /* mock of abstract method just to make extending possible */
        return new stdClass(); // returns empty object.
    }
}

class StockTest extends TestCase
{
    public $stock;

    public function setUp()
    {
        $this->stock = new TestProxyStock();
    }

    public function testAddSignleELement()
    {
        $element = 'silnik';
        $this->stock->add($element);

        $class = new ReflectionClass($this->stock);

        $property = $class->getProperty('stock');
        $property->setAccessible(true);
        $stock_array = $property->getValue($this->stock);
        $this->assertEquals($element, $stock_array[0]);
    }

    public function testAddMultipleElements()
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
