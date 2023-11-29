<?php

class Hash
{
    const REPEAT_HASH = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    /**
     * Hashes a string.
     *
     * @param string $string The string to hash.
     *
     * @return string The hashed string.
     */
    public static function generate($string)
    {
        $rounds = sprintf('%02d', 10);
        $salt = substr(str_shuffle(str_repeat(self::REPEAT_HASH, 5)), 0, 22);

        return crypt($string, '$2a$' . $rounds . '$' . $salt);
    }

    /**
     * Compares a string to a hash.
     *
     * @param string $input The raw string.
     * @param string $existingHash The hash.
     *
     * @return bool Does it match?
     */
    public static function compare($input, $existingHash)
    {
        $hash = crypt($input, $existingHash);

        return self::hashEquals($existingHash, $hash);
    }

    /**
     * Prevent timing attacking by comparing the two hashes using the same time whether they're equal or not.
     *
     * @link https://www.php.net/manual/en/function.hash-equals.php
     *
     * @param string $knownString
     * @param string $userString
     *
     * @return bool
     */
    private static function hashEquals($knownString, $userString)
    {
        if (function_exists('hash_equals')) {
            return hash_equals($knownString, $userString);
        }

        // For PHP < 5.6, since hash_equals() is only available in PHP >= 5.6
        if (strlen($knownString) !== strlen($userString)) {
            return false;
        }

        $return = 0;
        $result = $knownString ^ $userString;
        $total = strlen($result) - 1;
        for ($i = $total; $i >= 0; $i--) {
            $return |= ord($result[$i]);
        }

        return !$return;
    }
}
