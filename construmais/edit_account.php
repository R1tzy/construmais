<?php
session_start();

if (empty($_SESSION) || !isset($_SESSION["user_info"])) {
    header("Location: login.php");
    exit();
}

// Armazena os dados nas variáveis
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];

// Limpa os erros após exibi-los
unset($_SESSION['errors']); 
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
                    <li>
                        <div class="flex items-center">
                            <svg class="mx-1 h-4 w-4 text-orange-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                            </svg>
                            <a href="./edit_account.php" class="ms-1 text-sm font-medium text-white hover:text-orange-600 dark:text-orange-400 dark:hover:text-white md:ms-2">Edit Account</a>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Exibição de erros -->
            <div class="flex justify-center max-w-sm w-full rounded-lg">
                <?php if (!empty($errors)){ ?>
                    <div class="w-full space-y-3 mb-2"> <!-- Usando "space-y-3" para espaçar as mensagens -->
                        <?php foreach ($errors as $error){ ?>
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Erro!</strong>
                                <span class="block sm:inline"><?php echo $error; ?></span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </span>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>

            <!-- Formulário de edição -->
            <div class="shadow border max-w-sm w-full rounded-lg dark:border dark:bg-gray-800 dark:border-gray-700">
                <div class="px-4 py-5">
                    <h3 class="text-lg leading-6 font-medium text-gray-200">
                        Editar Informações
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-400">
                        Edite informações sobre o usuário.
                    </p>
                </div>
                
                <div class="border-t border-gray-600 px-4 py-5 sm:p-0">
                    <form action="./data_edit.php" method="POST">
                        <div class="flex flex-col">
                            <!-- Nome -->
                            <div class="mx-5 my-3 flex flex-row items-center gap-3">
                                <label for="name" class="text-sm font-medium text-gray-300 w-32">Nome</label>
                                <input id="name" type="text" name="name" class="bg-gray-800 text-gray-300 border border-gray-600 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600 h-10" value="<?php echo $_SESSION['user_info']['name'];?>" required>
                            </div>

                            <!-- Sobrenome -->
                            <div class="mx-5 my-3 flex flex-row items-center gap-3">
                                <label for="last_name" class="text-sm font-medium text-gray-300 w-32">Sobrenome</label>
                                <input id="last_name" type="text" name="last_name" class="bg-gray-800 text-gray-300 border border-gray-600 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600 h-10" value="<?php echo $_SESSION['user_info']['last_name'];?>" required>
                            </div>

                            <!-- E-mail -->
                            <div class="mx-5 my-3 flex flex-row items-center gap-3">
                                <label for="email" class="text-sm font-medium text-gray-300 w-32">Email</label>
                                <input id="email" type="email" name="email" class="bg-gray-800 text-gray-300 border border-gray-600 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600 h-10" value="<?php echo $_SESSION['user_info']['email'];?>" required>
                            </div>

                            <!-- Senha Atual -->
                            <div class="mx-5 my-3 flex flex-row items-center gap-3">
                                <label for="password" class="text-sm font-medium text-gray-300 w-32">Senha Atual</label>
                                <input id="password" type="password" name="password" class="bg-gray-800 text-gray-300 border border-gray-600 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600 h-10">
                            </div>

                            <!-- Senha Nova -->
                            <div class="mx-5 my-3 flex flex-row items-center gap-3">
                                <label for="password_new" class="text-sm font-medium text-gray-300 w-32">Senha Nova</label>
                                <input id="password_new" type="password" name="password_new" class="bg-gray-800 text-gray-300 border border-gray-600 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600 h-10">
                            </div>

                            <div class="flex justify-center">
                                <p class="text-[14px] text-red-400 m-2">Não quer mudar a senha, deixe em branco!</p>
                            </div>
                            
                            <!-- Botão para Editar -->
                            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-300"></dt>
                                <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                    <button type="submit" name="editar" value="editar" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-gray-200 hover:bg-blue-700">
                                        <svg class="-ms-0.5 me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path>
                                        </svg>
                                        Salvar
                                    </button>
                                </dd>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
