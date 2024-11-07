<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "construmais";

try{
    $conn = new PDO("mysql:host=$hostName;dbname=$dbName", $dbUser, $dbPassword);
    // Configure o PDO para lançar exceções em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexão Sucedida";
} catch(PDOException $e) {
    echo "Conexão Falha: " . $e->getMessage();
}
?>