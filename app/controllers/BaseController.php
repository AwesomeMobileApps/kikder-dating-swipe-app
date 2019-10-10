<?php

class BaseController
{
    private $modelsPath = './app/models/';
    private $name;

    public function loadModel($name)
    {
        $modelFile = $this->modelsPath . $name . '_model.php';
        require $modelFile;
        $this->name = $name;
    }

    public function modelFunction($func, array $vars = array())
    {
        $className = $this->name . '_model';
        return call_user_func_array(array(new $className, $func), $vars);
    }
}
