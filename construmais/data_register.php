<?php
session_start(); //inicia a sessão


// verifica se o botão de submit foi clicado, formulário enviado.
if(isset($_POST['register'])){
    #armazenamento dos valores nas variáveis
    $name = $_POST['name'];
    $last = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['confirm_password'];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $errors = array();

    
    //verificação do email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, "O email não é válido");
    }

    //verificação do tamanho da senha
    if(strlen($password) < 8){
        array_push($errors, "Senha mínima: 8 caracteres");
    }

    //verificação das senhas
    if($password !== $passwordRepeat){
        array_push($errors, "A senhas não coincidem");
    }

    //verifica se o e-mail já está cadastrado
    require_once "database.php";
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    //Se não houver nenhum usuário com esse e-mail, fetch() retornará false.
    // método execute() é chamado com um array que contém o valor que vai substituir o ?

    if($user){
        array_push($errors, "O e-mail já está cadastrado");
    }

    // Se houver erros, armazena na sessão e redireciona
    if(count($errors) > 0){
        $_SESSION['errors'] = $errors;
        header('Location: create_account.php'); // redireciona para o formulário
        exit();
    }
    else{
        
        // Prepara a consulta
        $sql = "INSERT INTO users (name, last_name, email, password) VALUES (?, ?, ?, ?)";
        // usa ? porque garante mais segurança.
        // também estou usando o PDO ao inves do msqli porque pode ser migrado para os SGBD mais facilmente
        $stmt = $conn->prepare($sql);
        
        // Execute a consulta com os dados
        try {
            $stmt->execute([$name, $last, $email, $passwordHash]);
            $_SESSION['success'] = "Registrado com Sucesso";
            header('Location: create_account.php');
            exit();
        } catch (PDOException $e) {
            $errors[] = "Error: " . $e->getMessage(); 
            // Adiciona a mensagem de erro ao array
            exit();
        }        

    }
}

?>