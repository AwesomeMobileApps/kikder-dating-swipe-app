<?php

class Session
{
    /**
     * Starts the session.
     * @return void
     */

    /**
     * Sets a session.
     * @param  string $key The key
     * @param  string $value The value
     * @return void
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Returns the value of a session
     * @param  string $key The key
     * @return boolean|string The value
     */
    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : FALSE;
    }

    /**
     * Destroys the session.
     * @return void
     */
    public static function destroy()
    {
        session_destroy();
    }

    public static function setacookie($name, $value)
    {
        setcookie($name, $value, time() + 60 * 60 * 24 * 365, '/', false);
    }

    public static function removeacookie($name)
    {
        setcookie($name, '', time() - 60 * 60 * 24 * 365, '/', false);
    }

    public static function showCookie($name)
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : FALSE;
    }
}