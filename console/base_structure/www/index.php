<?php

require_once ('../../vendor/autoload.php');

use FrameworkDevA3\Router\Router;
use FrameworkDevA3\CustomException\LayoutException;
use FrameworkDevA3\CustomException\CustomException;

$router = new Router($_GET['url']);
$router->get('/', ['controller'=>'PagesController', 'action'=>'home']);

$router->run();