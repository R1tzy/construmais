<?php
session_start();

require_once "database.php";

if (isset($_SESSION["user_id"])) {
    $stmt = $conn->prepare("SELECT id, name, last_name, email FROM users WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();

    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
} else{
    header("Location: login.php");
    exit();
}

$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
unset($_SESSION['success']);
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="relative font-sans w-full h-screen bg-cover bg-center" style="background-image: url('./img/construction.jpg');">
    <!-- Conteúdo centralizado -->
    <main class="min-h-screen flex items-center justify-center relative z-20"> 
        <!-- Sobreposição preta por baixo -->
        <div class="absolute inset-0 bg-black opacity-60 z-10"></div>

        <div class="m-5 flex flex-col items-center justify-center w-full relative z-20"> <!-- Flexbox para centralizar conteúdo -->
            <nav class="mb-4 flex items-center">
                <ol class="flex items-center justify-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="./index.php" class="inline-flex items-center text-sm font-medium text-white hover:text-orange-600 dark:text-orange-400 dark:hover:text-white">
                            <svg class="me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="mx-1 h-4 w-4 text-orange-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                            </svg>
                            <a href="./info_account.php" class="ms-1 text-sm font-medium text-white hover:text-orange-600 dark:text-orange-400 dark:hover:text-white md:ms-2">Account</a>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="flex justify-center max-w-sm w-full rounded-lg">
                <div class="w-full space-y-3 mb-2">
                    <?php if ($success){ ?>
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded text-teal-900 px-4 py-3 shadow-md" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    <p class="font-bold">Sucesso!</p>
                                    <p class="text-sm"><?php echo $success?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- Dados do Usuário -->
            <div class="shadow border max-w-sm w-full rounded-lg dark:border dark:bg-gray-800 dark:border-gray-700">
                    
                <div class="px-4 py-5">
                    <h3 class="text-lg leading-6 font-medium text-gray-200">
                        Perfil de Usuário
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-400">
                        Informações detalhadas sobre o usuário.
                    </p>
                </div>
                <div class="border-t border-gray-600 px-4 py-5 sm:p-0">
                    <dl>
                        <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-300">
                                Nome
                            </dt>
                            <dd class="mt-1 text-sm text-gray-300 sm:mt-0 sm:col-span-2">
                                <?php echo $user_info['name']; ?>
                            </dd>
                        </div>

                        <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-300">
                                Sobrenome
                            </dt>
                            <dd class="mt-1 text-sm text-gray-300 sm:mt-0 sm:col-span-2">
                                <?php echo $user_info['last_name']; ?>
                            </dd>
                        </div>

                        <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-300">
                                E-mail
                            </dt>
                            <dd class="mt-1 text-sm text-gray-300 sm:mt-0 sm:col-span-2">
                                <?php echo $user_info['email']; ?>
                            </dd>
                        </div>

                        <!-- Botão para Editar -->
                        <form action="./data_edit.php" method="POST">
                            <div>
                                <div class="p-3 text-sm sm:mt-0 sm:col-span-2 flex justify-center items-center mb-3">
                                    <button type="submit" data-modal-target="accountInformationModal" data-modal-toggle="accountInformationModal" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-gray-200 hover:bg-blue-700">
                                        <svg class="-ms-0.5 me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path>
                                        </svg>
                                        Editar Dados
                                    </button>
                                </div>
                            </div>
                        </form>
                    </dl>
                </div>
            </div>
        </div>
    </main>
</div>


</body>
</html>
