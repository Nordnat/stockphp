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
        $multielement = [
            ['name' => 'brakes', 'price' => 199, 'producent' => 'acme'],
            ['name' => 'wheel', 'price' => 199, 'producent' => 'firestor'],
            ['name' => 'mirror', 'price' => 199, 'producent' => 'mirrorland']
        ];
        foreach ($multielement as $element) {
            $this->stock->add($element);
        }

        $class = new ReflectionClass($this->stock);

        $property = $class->getProperty('stock');
        $property->setAccessible(true);
        $stock_array = $property->getValue($this->stock);
        $this->assertEquals($multielement[0], $stock_array[0]);
        $this->assertEquals(3, count($stock_array));
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

    public function testSuccessfulElementValidation()
    {
        $element = ['name' => 'brakes', 'price' => 199, 'producent' => 'acme'];

        $class = new ReflectionClass($this->stock);

        $method = $class->getMethod('validate');
        $method->setAccessible(true);
        $is_valid = $method->invokeArgs($this->stock, [$element]);
        $this->assertTrue($is_valid);
    }

    public function testFailureElementValidation()
    {
        $element = ['name' => 'brakes', 'producent' => 'acme'];

        $class = new ReflectionClass($this->stock);

        $method = $class->getMethod('validate');
        $method->setAccessible(true);
        $is_valid = $method->invokeArgs($this->stock, [$element]);
        $this->assertFalse($is_valid);
    }
}
