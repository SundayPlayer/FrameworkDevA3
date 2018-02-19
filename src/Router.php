<?php

include 'Route.php';

class Router {

    private $url; // contiendra l'URL sur laquelle on veut aller
    private $routes = [];

    public function __construct($url){
        $this->url = $url;
        echo $this->url;
    }

    // Permet l'ajout d'une route basique, à partir d'un URL et d'une fonction ou d'un controller à appeler.
    // Retourne la route prête.
    public function get($path, $function){
        $route = new Route($path, $function);
        $this->routes["GET"][] = $route;
        return $route;
    }

    public function run(){
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            return false;
        }
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->match($this->url)){
                return $route->call();
            }
        }
    }


}