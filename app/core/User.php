<?php

class User {
    private static $_userData;

    public static function store() {
        if (Main::loggedIn()) {
            Database::query('SELECT * FROM `users` WHERE `user_id` = :userid', array(
                ':userid'    =>    Session::showCookie('userId')
            ));

            static::$_userData = Database::fetch();
        }
    }

    public static function userName() {
        if (static::loggedIn()) {
            return static::$_userData->user_name;
        }
    }

    public static function userPicture() {
        if(static::loggedIn()) {
            return static::$_userData->user_picture;
        }
    }

    public static function userId() {
        if (static::loggedIn()) {
            return static::$_userData->user_id;
        }
    }
    public static function getAvatar($kikUsername) {

        $url = 'https://www.kik.me/u/' . $kikUsername;
        $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
        $context = stream_context_create($opts);
        $html = file_get_contents($url,false,$context);
        $doc = new DOMDocument();
        @$doc->loadHTML($html);
        $xpath = new DOMXPath($doc);
        $metaContentAttributeNodes = $xpath->query('/html/head/meta[@property="og:image"]/@content');

        foreach($metaContentAttributeNodes as $metaContentAttributeNode)
        {
            $thumb = $metaContentAttributeNode->nodeValue;
            return str_replace(array('thumb', 'http://'), array('orig', 'https://'), $thumb);
        }
    }

    public static function loggedIn() {
        return Session::showCookie('loggedIn');
    }

}