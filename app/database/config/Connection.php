<?php

namespace app\database\config;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

final class Connection {
    private static $connection;
    private static function configureConnection() {
            if (!isset(self::$connection)){
            self::$connection = new \PDO("mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'] , $_ENV['DB_PASS']);
            
            try {
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