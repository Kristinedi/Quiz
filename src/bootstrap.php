<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// Globals
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('VIEW_BASE_FOLDER') || define('VIEW_BASE_FOLDER', __DIR__ . DS . 'views');
defined('TEMPLATE_BASE_FOLDER') || define('TEMPLATE_BASE_FOLDER', __DIR__ . DS . 'templates');

require_once 'functions.php';

// Database
$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => DRIVER,
    'host'      => HOST,
    'database'  => DATABASE,
    'username'  => USERNAME,
    'password'  => PASSWORD,
    'charset'   => CHARSET,
    'collation' => COLLATION,
    'prefix'    => PREFIX,
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
