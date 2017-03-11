<?php

namespace Stock\Core\Config;

use Stock\Contracts\Configurable;

class DBConfig extends Config implements Configurable
{
    /**
     * Get database config values using dot notation.
     * Value will be stored in array cache for next use.
     *
     * @param string $config
     *
     * @return null
     * @example
     * <code>
     * $db_user = \Stock\Core\DBConfig::get('username');
     * </code>
     */
    public static function get($config = null)
    {
        $instance = static::getInstance();
        $config_keys = $instance->splitToArray($config);

        $config = $config ?: 'database';
        if (! array_key_exists($config, static::$cache)) {
            $configs = static::getInstance()->requireConfigFile('database');
            $configs = $configs['connections'][$configs['default']];
            foreach ($config_keys as $key) {
                $configs = $configs[$key];
            }
            static::$cache[$config] = $configs;
        }

        return static::$cache[$config];
    }
}
