<?php

use Core\DBConnection;
use PHPUnit\Framework\TestCase;

class DBConnectionTest extends TestCase
{
    public function testRawQuery()
    {
        $db = new DBConnection;

        $this->assertEquals(3, $db->rawQuery('SELECT 1 + 2;')->fetchColumn());
        $this->assertInternalType('array', $db->rawQuery('SELECT 1;')->fetch());
        $this->assertInternalType('array', $db->rawQuery('SELECT 1;')->fetchAll());
    }

    public function testPrepareStatementQuery()
    {
        $db = new DBConnection;

        $statement = 'SELECT :a + :b;';
        $args = [':a' => 1, ':b' => 2];

        $this->assertEquals(3, $db->query($statement, $args)->fetchColumn());
        $this->assertInternalType('array', $db->query($statement, $args)->fetch());
        $this->assertInternalType('array', $db->query($statement, $args)->fetchAll());
    }
}
