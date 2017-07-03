<?php

class BaseController
{
    public $root = './app/models/';
    public $name;

    public function loadModel($name)
    {
        $modelFile = $this->root . $name . '_model.php';
        include_once($modelFile);
        $this->name = $name;
    }

    public function modelFunction($func, array $vars = array())
    {
        $className = $this->name . '_model';
        return call_user_func_array(array(new $className, $func), $vars);
    }
}