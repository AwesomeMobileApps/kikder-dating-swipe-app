<?php

class Route
{
    /** @var array */
    private $_uri = array();

    /** @var array */
    private $_method = array();

    /** @var array */
    private $_class = array();

    /**
     * @param string $uri
     * @param string $method
     */
    public function add($uri, $method = '')
    {
        $this->_uri[] = '/' . trim($uri, '/');
        $this->_method[] = $method;
    }

    public function run()
    {
        $url = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';
        foreach ($this->_uri as $key => $value) {
            if (preg_match("#^$value$#", $url, $params)) {
                $method = $this->_method[$key];
                if (strpos($method, '@')) {
                    $split = explode('@', $method);
                    $this->_class[] = $split[0];
                    $this->_function[] = $split[1];
                } else {
                    $this->_method[] = $method;
                    $this->_function[] = null;
                }
                if (empty($method)) {
                    echo 'Please make sure your route is calling a class function.';
                } else {
                    $class = new $this->_class[0];
                    $classFunction = $this->_function[0];
                    if (method_exists($class, $classFunction)) {
                        foreach ($params as $k => $v) {
                            $params[$k] = str_replace('/', '', $v);
                        }
                        return call_user_func_array(array($class, $classFunction), $params);
                    } else {
                        echo 'Function <b>' . $classFunction . '</b> was not found in the class <b>' . $this->_class[0] . '</b>';
                        exit;
                    }
                }
            } else {
                // TODO From Kik ctrl, call a nice 404 page method
                header('HTTP/1.1 404 Not Found');
                echo 'Page Not Found!';
                exit;
            }
        }
    }
}