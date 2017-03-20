<?php
use Stock\Models\LifoStock;

// możemy na razie zweryfikować czy ID został nadany.
// Jak zaimplementujemy metodę "get" w repozytorium to będziemy mogli poprawić te testy aby sprawdzić czy faktycznie
// baza danych została poprawnie zaktualizowana i wszystkie elementy się w niej znajdują.

class SaveStockToDbTest extends \PHPUnit\Framework\TestCase
{
    public function testSavingStock()
    {
        $randomNumber = rand(1, 999999999);
        $stock = new LifoStock();
        $stock->name = 'First lifo stock' . $randomNumber . '';
        $stock->type = 'LIFO';
        $stock->save();

        $this->assertTrue($stock->id > 0);
    }
}
