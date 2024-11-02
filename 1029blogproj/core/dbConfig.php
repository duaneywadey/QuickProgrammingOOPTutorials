<?php  

session_start();

$host = "localhost";
$user = "root";
$password = "";
$dbname = "dequito";
$dsn = "mysql:host={$host};dbname={$dbname}";

$pdo = new PDO($dsn,$user,$password);
$pdo->exec("SET time_zone = '+08:00';");

define("BASE_URL", "http://localhost/quickprogrammingoop/1029blogproj");

?>