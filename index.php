<?php
require_once('connection.php');
require("vendor/autoload.php");
// $openapi = \OpenApi\scan('./controllers');
// header('Content-Type: application/x-yaml');
// echo $openapi->toYaml();

if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'index';
    }
} else {
    $controller = 'pages';
    $action = 'home';
}

require_once('routes.php');