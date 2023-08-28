<?php
require 'vendor/autoload.php';
use App\Router;


$router = new Router('./views/');
$router
	->add('/people', 'people/index')
	->add('/people/[id]', 'people/show')
	->add('/cities', 'cities/index')
	->add('/cities/[zip]', 'cities/show')
;

$router->run();