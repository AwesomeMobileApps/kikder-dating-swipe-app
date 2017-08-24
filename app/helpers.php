<?php

function site_url($var = '') {
    if (!empty($var)) {
        return SITE_URL . $var;
    }

    return SITE_URL;
}

function asset_url($var) {
    return SITE_URL . 'assets/' . $var;
}

function redirect($url) {
    if (strpos($url, 'http') === false) {
        $url = SITE_URL . $url;
    }
    header('Location: ' . $url);
    exit;
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
