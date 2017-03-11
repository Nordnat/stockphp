<?php
use PHPUnit\Framework\TestCase;
use Stock\Models\Goods;
use Stock\Models\LifoStock;

class LifoStockTest extends TestCase
{
    public $stock;

    public function setUp()
    {
        $this->stock = new LifoStock();
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

        $property = $class->getProperty('goods');
        $property->setAccessible(true);
        $stock_array = $property->getValue($this->stock);
        $this->assertCount(2, $stock_array);
        $this->assertEquals($taken_element, $element[2]);
    }
}
