<?php

function site_url($var = '') {
    if (!empty($var)) {
        return SITE_URL . $var;
    }

    return SITE_URL;
}

require 'core/Route.php';
require 'core/Database.php';
require 'core/Main.php';
require 'core/View.php';
require 'core/User.php';
require 'core/Session.php';
require 'core/Input.php';
require 'core/Hash.php';

function autoloadController($className) {
    $filename = './app/controllers/' . $className . '.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

spl_autoload_register('autoloadController');


function asset_url($var = '') {
    if (!empty($var)) {
        return SITE_URL . $var;
    } else {
        return SITE_URL . 'assets/';
    }
}

function redirect($url) {
    header('Location: .' . $url);
}

function error($type) {
    echo $type;
}

function clean($key) {
    return addslashes(htmlentities(trim($key)));
}

function s_excerpt($content, $end, $append) {
    if (strlen($content) > $end) {
        $excerpt = substr($content, 0, strrpos($content, ' '));
        $excerpt .= $append;
    } else {
        $excerpt = $content;
    }

    return $excerpt;
}

// Let's run the app!
$route = new Route();
require 'routes.php';

Main::store();
Database::connect(Main::get('db'));
User::store();

$route->run(); // Last one, run the URI router


