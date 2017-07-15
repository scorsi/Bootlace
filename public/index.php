<?php

require_once '../vendor/autoload.php';
require_once '../config/config.php';
require_once '../library/autoload.php';

error_reporting(E_ALL);
ini_set('log_errors', 'On');
ini_set('error_log', __DIR__ . '/../log/error.log');
ini_set('display_errors', 'On');

$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

\Kint_Renderer_Rich::$theme = 'solarized-dark.css';


$kernel = new \Bootlace\Kernel(
    __DIR__ . DIRECTORY_SEPARATOR . '..',
    '/bootlace-framework/public');

$kernel->execute();
