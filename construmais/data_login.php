<?php
session_start(); //inicia a sessão


// verifica se o botão de submit foi clicado, formulário enviado.
if(isset($_POST['login'])){
    #armazenamento dos valores nas variáveis
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = array();

    require_once "database.php";
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        //verifica a senha
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_name"] = $user["name"];
            $_SESSION["user_id"] = $user["id"];
            header("Location: index.php");
            exit();
        } else{
            array_push($errors, "Senha não corresponde");
        } 
    } else{
        array_push($errors, "Email não encontrado");
    }
    

    // Se houver erros, armazena na sessão e redireciona
    if(count($errors) > 0){
        $_SESSION['errors'] = $errors;
        header('Location: login.php'); // redireciona para o formulário
        exit();
    }
}

?>