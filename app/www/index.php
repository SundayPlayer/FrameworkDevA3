<?php

include '../../src/Router.php';

$router = new Router($_GET['url']);
$router->get('/', function(){ echo "Page index !"; });

$router->run();