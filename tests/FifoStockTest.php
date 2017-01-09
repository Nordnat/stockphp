<?php
use PHPUnit\Framework\TestCase;
use Stock\Models\FifoStock;

class FifoStockTest extends TestCase
{
    public $stock;

    public function setUp()
    {
        $this->stock = new FifoStock();
    }

    public function testTake()
    {
        $element = [
            ['name' => 'brakes', 'price' => 199, 'producent' => 'acme'],
            ['name' => 'wheel', 'price' => 199, 'producent' => 'firestor'],
            ['name' => 'mirror', 'price' => 199, 'producent' => 'mirrorland']
        ];
        $this->stock->add_many($element);
        $taken_element = $this->stock->take();
        $class = new ReflectionClass($this->stock);

        $property = $class->getProperty('stock');
        $property->setAccessible(true);
        $stock_array = $property->getValue($this->stock);
        $this->assertEquals(2, count($stock_array));
        $this->assertEquals($taken_element, $element[0]);
    }
}
