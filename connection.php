<?php
use MongoDB\Client;
use MongoDB\Exception\Exception;

require_once 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class DB {
    private static $instance = NULL;
    public static function getInstance() {
        if (!isset(self::$instance)) {
            try {
                $conn = new Client("mongodb://127.0.0.1:27017");
                self::$instance = $conn->selectDatabase('ict_hub');
            } catch (Exception $ex) {
                die($ex);
            }
        }
        return self::$instance;
    }
}