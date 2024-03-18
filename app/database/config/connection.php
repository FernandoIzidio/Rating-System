<?php

require_once "/var/www/Evaluation-System/vendor/autoload.php";


$dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

$dbHost = $_ENV['DB_HOST'];
$dbUser = $_ENV['DB_USER'];
$dbPass = $_ENV['DB_PASS'];
$dbName = $_ENV['DB_NAME'];

try{
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", "$dbUser", "$dbPass");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo "Erro ao tentar conectar ao banco de dados: ".$e->getMessage();
}
