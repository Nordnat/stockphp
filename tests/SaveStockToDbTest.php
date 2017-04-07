<?php
use Stock\Models\LifoStock;

class SaveStockToDbTest extends \PHPUnit\Framework\TestCase
{
    public function testSavingStock()
    {
        $randomNumber = rand(1, 999999999);
        $stock = new LifoStock();
        $stock->name = 'First lifo stock' . $randomNumber . '';
        $stock->type = 'LIFO';
        $stock->save();

        $this->assertGreaterThan(0, $stock->id);
    }
}
