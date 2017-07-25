<?php

class View
{
    /**
     * @param string $view
     * @param string $title
     * @param array $data
     */
    public static function create($view, $title = '', array $data = array())
    {
        extract($data);
        $template_url = 'templates/';
        include_once($template_url . 'header.php');
        $file = $template_url . $view . '.php';
        if (file_exists($file)) {
            include_once($template_url . $view . '.php');
        } else {
            die('Could not find file: <b>' . $file . '</b>');
        }
        include_once($template_url . 'footer.php');
    }

    /**
     * @param string $view
     * @param string $title
     * @param int $paritals
     * @param array $data
     */
    public static function admin($view, $title = '', $paritals = 1, array $data = array())
    {
        extract($data);
        if (!$paritals == 1) {
            include_once('app/admin/templates/' . $view . '.php');
        } else {
            include_once('app/admin/templates/header.php');
            include_once('app/admin/templates/' . $view . '.php');
            include_once('app/admin/templates/footer.php');
        }
    }
}