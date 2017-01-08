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
        $element = ['name' => 'brakes', 'price' => 199, 'producent' => 'acme'];
        $this->stock->add($element);

        $class = new ReflectionClass($this->stock);

        $property = $class->getProperty('stock');
        $property->setAccessible(true);
        $stock_array = $property->getValue($this->stock);
        $this->assertEquals($element, $stock_array[0]);
    }

    public function testAddSignleEmptyELement()
    {
        $emptyElement = [];
        $this->stock->add($emptyElement);

        $class = new ReflectionClass($this->stock);

        $property = $class->getProperty('stock');
        $property->setAccessible(true);
        $stock_array = $property->getValue($this->stock);
        $this->assertEquals(0, count($stock_array));
    }

    public function testAddMultipleElements()
    {
        $element1 = ['name' => 'brakes', 'price' => 199, 'producent' => 'acme'];
        $element2 = ['name' => 'wheel', 'price' => 199, 'producent' => 'firestore'];
        $multiElement = [$element1, $element2];
        $this->stock->add_many($multiElement);

        $class = new ReflectionClass($this->stock);

        $property = $class->getProperty('stock');
        $property->setAccessible(true);
        $stock_array = $property->getValue($this->stock);
        $this->assertEquals($stock_array[0], $element1);
        $this->assertEquals($stock_array[1], $element2);
        $this->assertEquals(2, count($stock_array));
    }
}
