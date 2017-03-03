<?php
use PHPUnit\Framework\TestCase;
use Stock\Models\Goods;
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
        $element = new Goods([
            'name' => 'brakes', 'price' => 220.80, 'producer' => 'Brakers', 'quantity' => 30
        ]);

        $this->stock->add($element);

        $class = new ReflectionClass($this->stock);

        $property = $class->getProperty('goods');
        $property->setAccessible(true);
        $stock_array = $property->getValue($this->stock);
        $this->assertEquals($element, $stock_array[0]);
    }

    public function testAddMultipleElements()
    {
        $element = [
            new Goods(['name' => 'brakes', 'price' => 199.00, 'producer' => 'acme', 'quantity' => 20]),
            new Goods(['name' => 'wheel', 'price' => 199.77, 'producer' => 'firestor', 'quantity' => 20]),
            new Goods(['name' => 'mirror', 'price' => 199.77, 'producer' => 'mirrorland', 'quantity' => 20]),
        ];
        $this->stock->add_many($element);

        $class = new ReflectionClass($this->stock);

        $property = $class->getProperty('goods');
        $property->setAccessible(true);
        $stock_array = $property->getValue($this->stock);
        $this->assertEquals($stock_array[0], $element[0]);
        $this->assertEquals($stock_array[1], $element[1]);
        $this->assertCount(3, $stock_array);
    }
}
