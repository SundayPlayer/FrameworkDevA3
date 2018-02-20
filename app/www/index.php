<?php

require_once ("../../vendor/autoload.php");

use FrameworkDevA3\Router\Router;

$router = new Router($_GET['url']);
$router->get('/', function(){ echo "Page index !"; });