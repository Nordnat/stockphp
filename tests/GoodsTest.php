<?php
use PHPUnit\Framework\TestCase;
use Stock\Models\Goods;

class GoodsTest extends TestCase
{
    public $goods;

    public function setUp()
    {
        $this->goods = new Goods(['name' => 'brakes', 'price' => 199.00, 'producer' => 'acme', 'quantity' => 20]);
    }

    public function testCheckTypeMethod()
    {
        $class = new ReflectionClass($this->goods);
        $method = $class->getMethod('check_type');
        $method->setAccessible(true);

        $this->assertTrue($method->invokeArgs($this->goods, ['silnik', 'string']));
        $this->assertTrue($method->invokeArgs($this->goods, [124, 'integer']));
        $this->assertTrue($method->invokeArgs($this->goods, [199.00, 'double']));
        $this->assertFalse($method->invokeArgs($this->goods, [20, 'string']));
        $this->assertFalse($method->invokeArgs($this->goods, [199, 'double']));
    }

    public function testCheckRequiredMethod()
    {
        $class = new ReflectionClass($this->goods);
        $method = $class->getMethod('check_required');
        $method->setAccessible(true);

        $this->assertTrue($method->invokeArgs($this->goods, ['silnik', true]));
        $this->assertTrue($method->invokeArgs($this->goods, [ null, false]));
        $this->assertFalse($method->invokeArgs($this->goods, [ null, true]));
    }

    public function testGoodsValidationMethod()
    {
        $good_proper = ['name' => 'brakes', 'price' => 199.00, 'producer' => 'acme', 'quantity' => 20];
        $good_wrong_type = ['name' => 'brakes', 'price' => '199.00', 'producer' => 'acme', 'quantity' => 20];
        $good_lack_required = ['name' => null, 'price' => 199.00, 'producer' => 'acme', 'quantity' => 20];

        $class = new ReflectionClass($this->goods);
        $method = $class->getMethod('goodsValidation');
        $method->setAccessible(true);

        $this->assertTrue($method->invokeArgs($this->goods, [$good_proper, true]));
        $this->assertFalse($method->invokeArgs($this->goods, [$good_wrong_type, false]));
        $this->assertFalse($method->invokeArgs($this->goods, [$good_lack_required, false]));
    }

    public function testGoodsSerialCodeGenerator()
    {
        $class = new ReflectionClass($this->goods);
        $method = $class->getMethod('serialCodeGenerator');
        $method->setAccessible(true);
        $serialCode = $method->invokeArgs($this->goods, [$this->goods]);
        $this->assertRegExp('/[a-zA-Z]{3}[0-9]{13}/', $serialCode);
    }
}
