<?php

class User
{
    const KIK_AVATAR_URL = 'https://www.kik.me/u/';

    /** @var stdClass The user fields */
    private static $_userData;

    public static function store()
    {
        if (Main::loggedIn()) {
            Database::query('SELECT * FROM `users` WHERE `user_id` = :userid', array(
                ':userid' => Session::showCookie('userId')
            ));

            static::$_userData = Database::fetch();
        }
    }

    /**
     * @return string|void
     */
    public static function userName()
    {
        if (static::loggedIn()) {
            return static::$_userData->user_name;
        }
    }

    /**
     * @return string|bool
     */
    public static function loggedIn()
    {
        return Session::showCookie('loggedIn');
    }

    /**
     * @return string
     */
    public static function userPicture()
    {
        if (static::loggedIn()) {
            return static::$_userData->user_avatar;
        }
    }

    /**
     * @return int
     */
    public static function userId()
    {
        if (static::loggedIn()) {
            return static::$_userData->user_id;
        }
    }

    /**
     * @param string $kikUsername
     *
     * @return string
     */
    public static function getAvatar($kikUsername)
    {
        $url = self::KIK_AVATAR_URL . $kikUsername;
        $opts = array('http' => array('header' => "User-Agent:MyAgent/1.0\r\n"));
        $context = stream_context_create($opts);
        $html = file_get_contents($url, false, $context);
        $doc = new DOMDocument();
        @$doc->loadHTML($html);
        $xpath = new DOMXPath($doc);
        $metaContentAttributeNodes = $xpath->query('/html/head/meta[@property="og:image"]/@content');

        foreach ($metaContentAttributeNodes as $metaContentAttributeNode) {
            $thumb = $metaContentAttributeNode->nodeValue;
            return str_replace(array('thumb', 'http://'), array('orig', 'https://'), $thumb);
        }
    }
}