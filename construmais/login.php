<?php

session_start(); //inicia sessão

// armazena  os dados nas variáveis
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];

//Limpa os erros após exibi-los
unset($_SESSION['errors']); 

// logado, redireciona para o index
if (isset($_SESSION["user_name"])) {
  header("Location: index.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="relative font-sans w-full h-screen bg-cover bg-center" style="background-image: url('./img/construction.jpg');">
        <div class="absolute inset-0 bg-black opacity-60 z-10"></div> <!-- Camada com opacidade -->
        
        <div class="relative z-20 flex flex-col items-center justify-center h-full p-6">
            <a href="./index.php" class="flex items-center mb-6 text-2xl font-semibold text-white">
                <img class="w-8 h-8 mr-2" src="./img/logo.png" alt="logo">
                Construmais   
            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Login
                    </h1>
                    <?php if (!empty($errors)){ ?>
                        <?php foreach ($errors as $error){ ?>
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Erro!</strong>
                                <span class="block sm:inline"><?php echo $error; ?></span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </span>
                            </div>
                        <?php } ?>
                    <?php } ?>

                    <form class="space-y-4 md:space-y-6" action="data_login.php" method="POST">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#E47624] focus:border-[#E47624] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#E47624] dark:focus:border-[#E47624]" placeholder="name@company.com" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#E47624] focus:border-[#E47624] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#E47624] dark:focus:border-[#E47624]" required="">
                        </div>
                        <button type="submit" vlaue="login" name="login" class="w-full text-white bg-[#E47624] hover:bg-[#F6A03D] focus:ring-4 focus:outline-none focus:ring-[#E47624] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#E47624] dark:hover:bg-[#F6A03D] dark:focus:ring-[#E47624]">Login</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don't have an account? <a href="./create_account.php" class="font-medium text-[#E47624] hover:underline dark:text-[#E47624]">Register here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>