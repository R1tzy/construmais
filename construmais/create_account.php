<?php

session_start(); //inicia sessão

// armazena  os dados nas variáveis
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;

//Limpa os erros após exibi-los
unset($_SESSION['errors']); 
unset($_SESSION['success']);

// já tá logado, também redireciona para o index
if (isset($_SESSION["user_name"])) {
    header("Location: index.php");
}
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Create Account</title>
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
                        Create an account
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

                    <?php if ($success){ ?>
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    <p class="font-bold">Sucesso!</p>
                                    <p class="text-sm"><?php echo $success?></p>
                                </div>
                            </div>
                        </div>
                    
                    <?php } ?>
                    <form class="space-y-4 md:space-y-6" action="data_register.php" method="POST">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#E47624] focus:border-[#E47624] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#E47624] dark:focus:border-[#E47624]" placeholder="Johnny" required="">
                        </div>
                        <div>
                            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#E47624] focus:border-[#E47624] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#E47624] dark:focus:border-[#E47624]" placeholder="Walker" required="">
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#E47624] focus:border-[#E47624] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#E47624] dark:focus:border-[#E47624]" placeholder="name@company.com" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#E47624] focus:border-[#E47624] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#E47624] dark:focus:border-[#E47624]" required="">
                        </div>
                        <div>
                            <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#E47624] focus:border-[#E47624] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#E47624] dark:focus:border-[#E47624]" required="">
                        </div>
                        <button type="submit" name="register" class="w-full text-white bg-[#E47624] hover:bg-[#F6A03D] focus:ring-4 focus:outline-none focus:ring-[#E47624] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-[#E47624] dark:hover:bg-[#F6A03D] dark:focus:ring-[#E47624]">Create an account</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Already have an account? <a href="./login.php" class="font-medium text-[#E47624] hover:underline dark:text-[#E47624]">Login here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>



</html>