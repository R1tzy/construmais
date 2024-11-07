<?php
session_start();

require_once "database.php";

$errors = array(); // Initialize errors array

if (isset($_POST['editar'])) {
    $name = $_POST['name'];
    $last = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordNew = $_POST['password_new'];

    // Inicializa a variável $passwordHash com a senha atual
    // Caso o usuário não queira mudar a senha, ela vai manter a senha do banco de dados.
    $passwordHash = null;

    // Pega a senha atual do banco de dados
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $db_password = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário forneceu senha atual e nova
    if (!empty($password) && !empty($passwordNew)) {
        // Valida o tamanho da senha
        if (strlen($passwordNew) < 8) {
            array_push($errors, "Senha mínima: 8 caracteres");
        }

        // Verifica se a senha informada é a mesma do banco de dados
        if (!password_verify($password, $db_password['password'])) {
            array_push($errors, "Senha atual incorreta!");
        } else {
            // Gera o hash para a nova senha
            $passwordHash = password_hash($passwordNew, PASSWORD_DEFAULT);
        }

    } 

    if ((!empty($password) && empty($passwordNew)) || (empty($password) && !empty($passwordNew))) {
        array_push($errors, "Preencha os campos de senha.");
    } elseif (empty($password) && empty($passwordNew)) {
        $passwordHash = $db_password['password']; // Mantém a senha atual
    }

    // Valida o e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "O email não é válido");
    }

    // Verifica se o usuário mudou o e-mail antes de validar a duplicidade
    if ($email !== $_SESSION['user_info']['email']) {
        // Verifica se o e-mail já está cadastrado (excluindo o próprio e-mail do usuário)
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            array_push($errors, "O e-mail já está cadastrado");
        }
    }

    // Se houver erros, retorna à página de edição com os erros
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header('Location: edit_account.php');
        exit();
    } else {
        // Atualiza os dados no banco de dados
        $sql = "UPDATE users SET name = ?, last_name = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        try {
            // Execute a consulta com os dados
            $stmt->execute([$name, $last, $email, $passwordHash, $_SESSION['user_id']]);
            $_SESSION['success'] = "Conta atualizada com sucesso!";
            header('Location: info_account.php');
            exit();
        } catch (PDOException $e) {
            $errors[] = "Erro ao atualizar os dados: " . $e->getMessage();
            $_SESSION['errors'] = $errors;
            header('Location: edit_account.php');
            exit();
        }
    }
}

// Para não tentar acessar a página de info por meio da URL
if (isset($_SESSION["user_id"])) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();

    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['user_info'] = $user_info;

    header("Location: edit_account.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>
