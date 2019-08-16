<?php

use Illuminate\Support\Arr;
use Quiz\Controllers\NotFoundController;
use Quiz\Controllers\AuthController;
use Quiz\Route;

require_once('../vendor/autoload.php');
require_once('../src/bootstrap.php');

/** @var Route[] $routes */
$routes = require_once('../src/routes.php');

$parsed = parse_url($_SERVER['REQUEST_URI']);
$path = $parsed['path'];

/** @var Route $route */
$route = Arr::get($routes, $path, new Route(NotFoundController::class));
$route->handle();
