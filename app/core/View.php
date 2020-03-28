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

        include 'templates/header.php';

        $file = 'templates/' . $view . '.php';
        if (is_file($file)) {
            include $file;
        } else {
            echo 'Could not find file: <b>' . $file . '</b>';
            exit;
        }

        include 'templates/footer.php';
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

        if ($paritals === 1) {
            include APP_PATH . 'admin/templates/' . $view . '.php';
        } else {
            include APP_PATH . 'admin/templates/header.php';
            include APP_PATH . 'admin/templates/' . $view . '.php';
            include APP_PATH . 'admin/templates/footer.php';
        }
    }
}
