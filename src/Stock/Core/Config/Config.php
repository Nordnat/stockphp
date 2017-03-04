<?php

namespace Stock\Core\Config;

use Stock\Contracts\Configurable;

class Config implements Configurable
{
    /**
     * @var static $config_instance;
     */
    protected static $config_instance;

    /**
     * Cached config values
     *
     * @var array $cache
     */
    protected static $cache = [];

    /**
     * Cached required files
     *
     * @var array $files;
     */
    protected static $files = [];

    /**
     * Checks if config instance exists, and if not, creates one.
     */
    public static function getInstance()
    {
        if (! static::$config_instance) {
            static::$config_instance = new static();
        }

        return static::$config_instance;
    }

    /**
     * Get config values using dot notation.
     * Value will be stored in array cache for next use.
     *
     * @param string $config
     *
     * @return null
     * @example
     * <code>
     * $db_user = \Stock\Core\Config::get('database.connections.local.username');
     * </code>
     */
    public static function get($config)
    {
        $instance = static::getInstance();
        $config_keys = $instance->splitToArray($config);

        // if config value not in cache
        if (! array_key_exists($config, static::$cache)) {
            // require config file
            $configs = $instance->requireConfigFile(array_shift($config_keys));
            foreach ($config_keys as $key) {
                $configs = $configs[$key];
            }
            static::$cache[$config] = $configs;
        }

        return static::$cache[$config];
    }

    /**
     * Will not override file config, just store new value in cache.
     *
     * @param string $config
     * @param mixed $value
     */
    public static function set($config, $value)
    {
        static::$cache[$config] = $value;
    }

    /**
     * Loads file with configuration, and stores in array cache.
     *
     * @param $file
     *
     * @return mixed
     */
    protected function requireConfigFile($file)
    {
        if (! array_key_exists($file, static::$files)) {
            static::$files[$file] = require __DIR__ . '../../../../../config/' . $file . '.php';
        }

        return static::$files[$file];
    }

    /**
     * @param $config
     *
     * @return array
     */
    protected function splitToArray($config)
    {
        return $config ? explode('.', $config) : [];
    }

    /**
     * Private Config constructor enforce singleton pattern.
     */
    protected function __construct()
    {
    }
}
