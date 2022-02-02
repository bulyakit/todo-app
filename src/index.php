<?php

use Slim\App;
use App\Bootstrap\Bootstrap;

require_once '../vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $settings    = require_once __DIR__ . '/Config/settings.php';
    $application = new App($settings);
    $bootstrap   = new Bootstrap($application);
    $bootstrap->initialize();

    $application->run();
} catch (Throwable $e) {
    echo $e->getMessage() . PHP_EOL;
}

