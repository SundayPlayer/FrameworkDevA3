<?php

require_once ('../../vendor/autoload.php');

use FrameworkDevA3\Router\Router;
use FrameworkDevA3\CustomException\LayoutException;
use FrameworkDevA3\CustomException\CustomException;

function monTest(){
	throw new LayoutException("test mess");
}

try{
	monTest();
}
catch(LayoutException $e){
	echo $e;
};

/*$router = new Router($_GET['url']);
$router->get('/', function(){ echo "Page index !"; });

$router->run();*/