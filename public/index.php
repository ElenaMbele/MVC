<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('SRC_DIRECTORY', realpath(__DIR__ . '/../src'));
require_once SRC_DIRECTORY.'/Tools/Application.php';

$app = new Application();

try{
    $app->run();
} catch (Exception $e) {
    echo $e->getMessage();
}
