<?php

function site_url($var = '') {
    if(!empty($var)) {
        return 'https://kikornot.com/'.$var;
    } else {
        return 'https://kikornot.com/';
    }
}

include_once('core/Route.php');
include_once('core/Database.php');
include_once('core/Main.php');
include_once('core/View.php');
include_once('core/User.php');
include_once('core/Session.php');
include_once('core/Input.php');
include_once('core/Hash.php');
Main::store();
Database::connect(Main::get('db'));

User::store();
$route = new Route();
function autoloadController($className) {
    $filename = './app/controllers/'.$className.'.php';
    if(is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register("autoloadController");


function asset_url($var = '') {
    if(!empty($var)) {
        return 'https://kikornot.com/'.$var;
    } else {
        return 'https://kikornot.com/assets/';
    }
}

function redirect($url) {
    header("Location: .".$url);
}

function error($type) {
    echo $type;
}

function clean($key) {
    return addslashes(htmlentities(trim($key)));
}

function s_excerpt($content, $end, $append) {
    if(strlen($content) > $end) {
        $excerpt = substr($content, 0, $end);
        $excerpt = substr($content, 0, strrpos($content, " "));
        $excerpt = $excerpt . $append;
    } else {
        $excerpt = $content;
    }
    return $excerpt;
}

require_once('routes.php');

$route->run();