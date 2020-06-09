<?php

use Core\Router;

require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Error and exception Handlers
 */
error_reporting(E_ALL);

set_error_handler("Core\Error::errorHandler");
set_exception_handler("Core\Error::exceptionHandler");



/**
 * Routing
 */
$router = new Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);

$url = $_SERVER['REQUEST_URI'];

/**
 * Dispatch Routes
 */
$router->dispatch($url);

function exceptionHandler($exception)
{
}
