<?php
use PHPUnit\Framework\TestCase;
use Stock\Models\FifoStock;
use Stock\Models\Goods;

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
            new Goods(['name' => 'brakes', 'price' => 199.00, 'producer' => 'acme', 'quantity' => 20]),
            new Goods(['name' => 'wheel', 'price' => 199.77, 'producer' => 'firestor', 'quantity' => 20]),
            new Goods(['name' => 'mirror', 'price' => 199.77, 'producer' => 'mirrorland', 'quantity' => 20]),
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
