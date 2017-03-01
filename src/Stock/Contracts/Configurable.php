<?php

namespace Stock\Contracts;

interface Configurable
{
    /**
     * Get config value using dot notation.
     * Value will be stored in array cache for next use.
     *
     * @param string $config
     *
     * @return mixed
     */
    public static function get($config);

    /**
     * Will not override file config, just store new value in cache.
     *
     * @param string $config
     * @param mixed $value
     */
    public static function set($config, $value);
}
