<?php
session_start();

require_once "database.php";

$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Construmais</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-['Roboto']">
  <header class="bg-gray-900 text-white flex justify-between items-center p-4 shadow-lg">
      <div class="flex items-center space-x-3">
          <img src="../project php/img/logo.png" class="h-10" alt="Construmais Logo" />
          <span class="text-2xl font-bold">Construmais</span>
      </div>
      <nav class="flex space-x-8">
          <a href="#" class="hover:text-orange-400 transition duration-300">Início</a>
          <a href="#produtos" class="hover:text-orange-400 transition duration-300">Produtos</a>
          <a href="#" class="hover:text-orange-400 transition duration-300">Sobre Nós</a>
          <a href="#" class="hover:text-orange-400 transition duration-300">Contato</a>
      </nav>
      <div class="flex items-center lg:space-x-4">
            <!-- Carrinho só aparece se o usuário estiver logado -->
            <?php if (isset($_SESSION["user_name"])) { ?>
                <div class="block">
                    <button id="myCartDropdownButton1" data-dropdown-toggle="myCartDropdown1" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
                        <span class="sr-only">Cart</span>
                        <svg class="w-5 h-5 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                        </svg> 
                        <span class="hidden sm:flex">My Cart</span>
                        <svg class="hidden sm:flex w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                        </svg>
                    </button>
                    <?php if(!empty($_SESSION['carrinho'])) { ?>
                        <div id="myCartDropdown1" class="hidden z-10 mx-auto max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 antialiased shadow-lg dark:bg-gray-800">
                            <?php foreach($_SESSION['carrinho'] as $productId => $quantidade) { 
                                // Encontrar produto na lista de produtos
                                $product = array_filter($products, fn($p) => $p['id'] == $productId);
                                $product = reset($product); // Obtém o primeiro (e único) resultado?>
                                
                                <div class="grid grid-cols-2">
                                    <div>
                                        <a href="#" class="truncate text-sm font-semibold leading-none text-gray-900 dark:text-white hover:underline"><?php echo htmlspecialchars($product['nome']); ?></a>
                                        <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">$<?php echo number_format($product['preco'], 2, ',', '.'); ?></p>
                                    </div>
                                    
                                    <div class="flex items-center justify-end gap-6">
                                        <p class="text-sm font-normal leading-none text-gray-500 dark:text-gray-400">Qtd: <?php echo $quantidade; ?></p>

                                        <form action="product.php" method="POST">
                                            <input type="hidden" name="remove" value="true">
                                            <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                            <button data-tooltip-target="tooltipRemoveItem1a" type="submit" class="text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                                <span class="sr-only"> Remover </span>
                                                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M2 12a10 10 0 1 1 20 0 10 10 0 0 1-20 0Zm7.7-3.7a1 1 0 0 0-1.4 1.4l2.3 2.3-2.3 2.3a1 1 0 1 0 1.4 1.4l2.3-2.3 2.3 2.3a1 1 0 0 0 1.4-1.4L13.4 12l2.3-2.3a1 1 0 0 0-1.4-1.4L12 10.6 9.7 8.3Z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                        <div id="tooltipRemoveItem1a" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                            Remover item
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <a href="#" class="mb-2 inline-flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 dark:bg-blue-600 dark:hover:bg-blue-700">
                                Pagamento
                            </a>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        
            <div class="flex items-center lg:space-x-4">
            <!-- Verificar se o usuário está logado -->
            <?php if (isset($_SESSION["user_name"])) { ?>
                <div class="block">
                    <!-- Botão de dropdown para "Account" -->
                    <button id="userDropdownButton1" data-dropdown-toggle="userDropdown1" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
                        <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                        <div class="capitalize"><?php echo htmlspecialchars($_SESSION["user_name"])?></div>
                        <svg class="w-4 h-4 text-gray-900 dark:text-white ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Dropdown de Conta -->
                    <div id="userDropdown1" class="hidden z-10 w-56 divide-y divide-gray-100 overflow-hidden rounded-lg bg-white shadow-lg dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
                            <li><a href="info_account.php" title="Edit Account" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">Account</a></li>
                        </ul>

                        <div class="p-2 text-sm font-medium text-gray-900 dark:text-white">
                            <a href="logout.php" title="Sign Out" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600">Sign Out</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- Botões para usuários não logados -->
            <?php if (!isset($_SESSION["user_name"])) { ?>
                <a href="./login.php" class="hover:text-orange-400">LOGIN</a>
                <a href="./create_account.php" class="bg-orange-600 px-4 py-2 rounded text-white hover:bg-orange-500 transition duration-300">SIGNUP</a>
            <?php } ?>
        </div>
    </div>

  </header>

  <main>
    <section class="relative h-[650px] bg-cover bg-center" style="background-image: url('../project php/img/construction.jpg'); background-attachment: fixed;">
      <div class="absolute inset-0 bg-black opacity-50"></div>
      <div class="relative h-full max-w-6xl mx-auto flex flex-col justify-center items-center text-center p-6 z-20">
          <h2 class="sm:text-5xl text-3xl font-bold mb-6 text-white">
              Construindo seu futuro <span class="block">com materiais de qualidade</span>
          </h2>
          <button type="button" class="mt-12 bg-orange-500 text-white text-base py-3 px-6 rounded hover:bg-orange-400 transition duration-300">
              Saiba Mais
          </button>
      </div>
    </section>

    <section class="bg-gray-50 py-8 antialiased md:py-12 mx-8" id="produtos">
        <h2 class="text-3xl font-bold text-center mb-8">Produtos</h2>
      <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
        <?php if (isset($products) && !empty($products)) { ?>
          <?php foreach ($products as $product) { ?>
              <div class="rounded-lg border bg-white p-6 shadow-sm dark:bg-gray-800 transition-transform duration-300 hover:shadow-lg">
                    <div class="w-full">
                        <a href="#">
                            <img class="h-[325px] w-[500px] rounded transition-transform duration-300 hover:scale-105 border-gray-300 shadow-sm" 
                                src="<?php echo htmlspecialchars($product['img']); ?>" 
                                alt="<?php echo htmlspecialchars($product['nome']); ?>" />
                        </a>
                    </div>
                    <div class="pt-6">
                        <a href="#" class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">
                            <?php echo htmlspecialchars($product['nome']); ?>
                        </a>
                        <p class="text-gray-600 dark:text-gray-400">
                                <?php echo htmlspecialchars($product['descricao']); ?>
                            </p>
                        <div class="mt-4 flex items-center justify-between">
                            <p class="text-2xl font-extrabold leading-tight text-gray-900 dark:text-white">
                                R$ <?php echo number_format($product['preco'], 2, ',', '.'); ?>
                            </p>
                            <?php if (!isset($_SESSION["user_name"])) { ?>
                                <button type="button" onclick="showAlert()" class="inline-flex items-center rounded-lg bg-orange-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-orange-600 dark:bg-orange-600 dark:hover:bg-orange-500 dark:focus:ring-orange-800">
                                    <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                    </svg>
                                    Adicionar ao Carrinho
                                </button>

                                <div id="alert" class="hidden fixed inset-0 z-50 flex items-center justify-center">
                                    <div class="flex items-center p-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                        </svg>
                                        <div>
                                            <span class="font-medium">Logue!</span> para adicionar itens ao carrinho.
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function showAlert() {
                                        const alertBox = document.getElementById('alert');
                                        alertBox.classList.remove('hidden');

                                        // Redireciona após 2 segundos
                                        setTimeout(() => {
                                            window.location.href = 'login.php';
                                        }, 2000); 
                                    }
                                </script>
                            <?php } else { ?>
                                <form action="product.php" method="POST">
                                    <button type="submit" name="add" class="inline-flex items-center rounded-lg bg-orange-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-orange-600 dark:bg-orange-600 dark:hover:bg-orange-500 dark:focus:ring-orange-800">
                                        <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                        </svg>
                                        Adicionar ao Carrinho
                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                    </button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
              </div>
          <?php } ?>
        <?php } else { ?>
            <p class="center">Nenhum produto encontrado</p>
        <?php } ?>
      </div>
    </section>

  </main>
  
  <footer class="bg-white rshadow dark:bg-gray-800">
    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
      <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="#" class="hover:underline">Construmais™</a>. Todos os Direitos Reservados.
      </span>
      <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
        <li>
            <a href="#" class="hover:underline me-4 md:me-6">Sobre</a>
        </li>
        <li>
            <a href="#" class="hover:underline me-4 md:me-6">Política de Privacidade</a>
        </li>
        <li>
            <a href="#" class="hover:underline me-4 md:me-6">Licenciamento</a>
        </li>
        <li>
            <a href="#" class="hover:underline">Contato</a>
        </li>
      </ul>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>  

</body>
</html>
