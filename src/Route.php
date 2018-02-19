<?php

class Route
{

    private $path;
    private $function;
    private $matches = [];

    public function __construct($path, $function)
    {
        $this->path = trim($path, '/');
        $this->function = $function;
    }

    public function match($url){
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = "#^$path$#i";
        if(!preg_match($regex, $url, $matches)){
            return false;
        } else {
            array_shift($matches);
            $this->matches = ($matches);
            return true;
        }
    }
}