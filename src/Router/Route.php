<?php

namespace FrameworkDevA3\Router;

use FrameworkDevA3\Controller;

class Route
{
    // PROPRIETES
    private $controllerDirectory = 'FrameworkDevA3\Controller\\';
    private $path;
    private $function;
    private $matches = [];

    // CONSTRUCTEUR
    public function __construct($path, $function)
    {
        $this->path = trim($path, '/');
        $this->function = $function;
    }

    // FONCTIONS
    public function match($url)
    {
        $url = trim($url, '/'); // suppression du / de fin
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = "#^$path$#i";
        if (!preg_match($regex, $url, $matches)) {
            return false;
        } else {
            array_shift($matches);
            $this->matches = ($matches);
            return true;
        }
    }

    public function call()
    {
        if (is_array($this->function)) {
            $controller = $this->controllerDirectory . $this->function['controller'];
            $action =  $this->function['action'];
            return $controller::$action();
        } else {
            return call_user_func_array($this->function, $this->matches);
        }
    }
}
