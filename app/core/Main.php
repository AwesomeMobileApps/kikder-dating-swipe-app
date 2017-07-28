<?php

class Main
{
    /** @var array */
    private static $_config = array();

    /**
     * @return bool|string
     */
    public static function loggedIn()
    {
        return Session::showCookie('loggedIn');
    }

    /**
     * Stores the config values into a property.
     *
     * @return void
     */
    public static function store()
    {
        if (empty(static::$_config)) {
            include_once APP_PATH . 'config/config.php';
            static::$_config = $config;
        }
    }

    /**
     * Returns a config value.
     *
     * @param  string $key The key
     * @param  string $secondKey Optional second key
     *
     * @return string|boolean    The value
     */
    public static function get($key, $secondKey = '')
    {
        if (empty($secondKey)) {
            return isset(static::$_config[$key]) ? static::$_config[$key] : FALSE;
        } else {
            return isset(static::$_config[$key][$secondKey]) ? static::$_config[$key][$secondKey] : FALSE;
        }
    }

    /**
     * Returns the excerpt.
     *
     * @param  string $str The incoming text
     * @param  intval $startPost Optional start pos
     * @param  intval $maxLength Optional max length
     * @param  string $append Optional append
     *
     * @return string|boolean    Excerpt
     */
    public static function excerpt($str, $startPos = 0, $maxLength = 250, $append = '...')
    {
        if (strlen($str) > $maxLength) {
            $excerpt = substr($str, $startPos, $maxLength - 3);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt = substr($excerpt, 0, $lastSpace);
            $excerpt .= $append;
        } else {
            $excerpt = $str;
        }

        return $excerpt;
    }
}