<?php

// Configurações do banco de dados
$hostName = "localhost"; // Servidor do banco de dados
$dbUser = "root"; // Usuário do MySQL
$dbPassword = ""; // Senha do MySQL (deixe em branco se não houver senha)
$dbName = "construmais"; // Nome do banco de dados
 
try{
    $conn = new PDO("mysql:host=$hostName;dbname=$dbName", $dbUser, $dbPassword);
    // Configure o PDO para lançar exceções em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexão Sucedida";
} catch(PDOException $e) {
    echo "Conexão Falha: " . $e->getMessage();
}
?>
