<?php
session_start();

require_once('database.php');

$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inicializar o carrinho na sessão, se não existir
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// adicionar no carrinho
if (isset($_POST['add'])) {
    $productId = $_POST['product_id'];
    $quantidade = 1; // Você pode permitir que o usuário escolha a quantidade

    // Se o produto já está no carrinho, aumenta a quantidade
    if (isset($_SESSION['carrinho'][$productId])) {
        $_SESSION['carrinho'][$productId] += $quantidade;
    } else {
        $_SESSION['carrinho'][$productId] = $quantidade;
    }

    // Você pode redirecionar ou mostrar uma mensagem de sucesso
    header("Location: index.php"); // Redireciona para a mesma página
    exit();
}

//remover do carrinho
if (isset($_POST['remove'])){
    $productId = $_POST['product_id'];
    if (isset($_SESSION['carrinho'][$productId])) {
        $_SESSION['carrinho'][$productId] -= 1;
        if($_SESSION['carrinho'][$productId] <= 0){
            unset($_SESSION['carrinho'][$productId]);
        }
    }
    header("Location: index.php");
    exit();
}

?>