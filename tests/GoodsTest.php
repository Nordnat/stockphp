<?php
use PHPUnit\Framework\TestCase;
use Stock\Models\Goods;

class GoodsTest extends TestCase
{
    public $goods_data = [];

    public function setUp()
    {
        $this->goods_data = ['name' => 'brakes', 'price' => 199.00, 'producer' => 'acme', 'quantity' => 20];
    }

    public function testValidationException()
    {
        $this->expectException(Exception::class);
        $goods = new Goods(['dupa' => 'fake']);
    }

    public function testCheckTypeMethod()
    {
        $goods = new Goods();
        
        $class = new ReflectionClass($goods);
        $method = $class->getMethod('check_type');
        $method->setAccessible(true);

        $this->assertTrue($method->invokeArgs($goods, ['silnik', 'string']));
        $this->assertTrue($method->invokeArgs($goods, [124, 'integer']));
        $this->assertTrue($method->invokeArgs($goods, [199.00, 'double']));
        $this->assertFalse($method->invokeArgs($goods, [20, 'string']));
        $this->assertFalse($method->invokeArgs($goods, [199, 'double']));
    }

    public function testCheckRequiredMethod()
    {
        $goods = new Goods();
        
        $class = new ReflectionClass($goods);
        $method = $class->getMethod('check_required');
        $method->setAccessible(true);

        $this->assertTrue($method->invokeArgs($goods, ['silnik', true]));
        $this->assertTrue($method->invokeArgs($goods, [ null, false]));
        $this->assertFalse($method->invokeArgs($goods, [ null, true]));
    }

    public function testGoodsValidationMethod()
    {
        $goods = new Goods();
        
        $good_proper = ['name' => 'brakes', 'price' => 199.00, 'producer' => 'acme', 'quantity' => 20];
        $good_wrong_type = ['name' => 'brakes', 'price' => '199.00', 'producer' => 'acme', 'quantity' => 20];
        $good_lack_required = ['name' => null, 'price' => 199.00, 'producer' => 'acme', 'quantity' => 20];

        $class = new ReflectionClass($goods);
        $method = $class->getMethod('goodsValidation');
        $method->setAccessible(true);

        $this->assertTrue($method->invokeArgs($goods, [$good_proper, true]));
        $this->assertFalse($method->invokeArgs($goods, [$good_wrong_type, false]));
        $this->assertFalse($method->invokeArgs($goods, [$good_lack_required, false]));
    }

    public function testGoodsSerialCodeGenerator()
    {
        $goods = new Goods($this->goods_data);

        $class = new ReflectionClass($goods);
        $method = $class->getMethod('serialCodeGenerator');
        $method->setAccessible(true);
        $serialCode = $method->invokeArgs($goods, [$goods]);
        $this->assertRegExp('/[a-zA-Z]{3}[0-9]{13}/', $serialCode);
    }
}
