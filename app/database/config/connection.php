<?php

namespace app\database\config;
use Dotenv\Dotenv;

require_once "../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

final class Connection {
    private static $dbHost;
    private static $dbUser;
    private static $dbPass;
    private static $dbName;

    private static $connection;

    private static function configureConnection() {
        if (!isset(self::$connection)){
            self::$dbHost = $_ENV['DB_HOST'];
            self::$dbUser = $_ENV['DB_USER'];
            self::$dbPass = $_ENV['DB_PASS'];
            self::$dbName = $_ENV['DB_NAME'];


            try {
                self::$connection = new \PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$dbPass);
                self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                echo "Erro de conexão: " . $e->getMessage();
                exit();
            }
            
        } 
    }

    public static function getConnection() {
        self::configureConnection();
        return self::$connection;
    }
      
}


