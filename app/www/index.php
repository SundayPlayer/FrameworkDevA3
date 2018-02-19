<?php

include '../../src/Router.php';

$router = new Router($_GET['url']);
$router->get('/', function(){ echo "Mdr !"; });
$router->get('/:data', function($id){ echo "Mais dis-donc, voilà $id !"; });
$router->run();