<?php

use Stock\Core\Database\DBConnection;
use Stock\Models\FifoStock;
use Stock\Models\StockRepository;

// na chwile obecną nie posiadamy query, które będzie pobierać dane z bazy więc nie jesteśmy w stanie zweryfikować
// czy faktycznie wszystkie dane zapisały się poprawnie. Możemy zweryfikować czy wygenerowany został nowy ID.
class StockRepositoryTest extends \PHPUnit\Framework\TestCase
{
    public function testSavingStock()
    {
        $db = new DBConnection();
        $stock = new FifoStock;
        $stock->type = 'FIFO';
        $stock->name = 'First fifo stock for testing2';

        $repository = new StockRepository($db);
        $stock->id = $repository->save($stock);
        $this->assertTrue($stock->id > 0); // ponieważ ID powinno istnieć i być większe od zera.
    }
}
