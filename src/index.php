<?php

use Slim\App;
use ToDoApp\Bootstrap\Bootstrap;

require_once __DIR__ . '/vendor/autoload.php';
echo "IMALIVE";
//$config = [];
//$api = new \Kcs\Api\Api($config);
//
//$api->run();

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $settings    = require_once __DIR__ . '/ToDoApp/Config/settings.php';
    $application = new App($settings);
    $bootstrap = new Bootstrap($application);
    $bootstrap->initialize();

    $application->run();

} catch (Throwable $e) {
    echo 'caught' . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}


//$app = new \Slim\App();
//
//require_once('routes.php');
//
//$app->run();
//
//function getEmployes($response) {
//    return json_encode(['live' => 'yes']);
//    $sql = "select * FROM employee";
//    try {
//        $stmt = getConnection()->query($sql);
//        $wines = $stmt->fetchAll(PDO::FETCH_OBJ);
//        $db = null;
//
//        return json_encode($wines);
//    } catch(PDOException $e) {
//        echo '{"error":{"text":'. $e->getMessage() .'}}';
//    }
//}
//
//function getConnection() {
//    $dbhost="127.0.0.1";
//    $dbuser="root";
//    $dbpass="test";
//    $dbname="test";
//    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
//    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    return $dbh;
//}

