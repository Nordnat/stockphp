<?php

use PHPUnit\Framework\TestCase;
use Stock\Core\Config\Config;
use Stock\Core\Config\DBConfig;

class ConfigTest extends TestCase
{
    public function testGeneralConfig()
    {
        $db_default = Config::get('database.default');
        $this->assertEquals('test', $db_default);

        $db_user = Config::get('database.connections.' . $db_default . '.username');
        $this->assertEquals('root', $db_user);
    }

    public function testDBConfig()
    {
        $db_user = DBConfig::get('username');
        $this->assertEquals('root', $db_user);
    }

    public function testSettingConfig()
    {
        Config::set('this.is.a.test', 'I am test!');

        $this->assertEquals('I am test!', Config::get('this.is.a.test'));
    }
}
