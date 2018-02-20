<?php

namespace FrameworkDevA3\Router;

class Route
{
    // PROPRIETES
    private $controllerDirectory;
    private $path;
    private $function;
    private $matches = [];

    // CONSTRUCTEUR
    public function __construct($path, $function, $controllerDirectory = "")
    {
        $this->path = trim($path, '/');
        $this->function = $function;
        if ($controllerDirectory !== "") {
            $controllerDirectory = $controllerDirectory . "/";
        }
        $this->controllerDirectory = $controllerDirectory;
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
        if (is_string($this->function)) {
            $params = explode('#', $this->function);
            $controller = $this->controllerDirectory . $params[0] . "Controller.php";
            $controller = new $controller();
            return call_user_func_array($controller, $this->matches);
        } else {
            return call_user_func_array($this->function, $this->matches);
        }
    }
}
