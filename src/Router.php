<?php
class Router {

    private $url; // contiendra l'URL sur laquelle on veut aller
    private $routes = [];

    public function __construct($url){
        $this->url = $url;
        echo $this->url;
    }





}