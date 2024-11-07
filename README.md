# Construmais - README

**Construmais** é uma plataforma de e-commerce voltada para a venda de materiais de construção essenciais para a construção civil, como cimento, areia, brita, entre outros. O objetivo inicial era criar um site que permitisse comparar os preços desses produtos entre diferentes lojas da cidade de Presidente Prudente, facilitando a busca pelos melhores preços. No entanto, como as lojas locais não possuíam sites próprios para consulta de preços e compras, o projeto foi adaptado para funcionar como um e-commerce para essas lojas, reunindo informações sobre seus produtos e oferecendo uma plataforma única de vendas online focada nesse nicho.

## Tecnologias Utilizadas

- **PHP** (versão 7.x ou superior)
- **MySQL** (para gerenciamento do banco de dados)
- **Tailwind CSS** (para o estilo da interface)
- **PDO** (para conexão com o banco de dados)
- **JavaScript** (para interatividade do frontend)

## Pré-requisitos

Antes de começar, você precisa ter o seguinte instalado:

1. **Servidor Web (Apache ou Nginx)**: Para rodar o PHP localmente.  
   - Se você não estiver usando **XAMPP** ou **WAMP**, pode instalar o Apache manualmente. O Apache pode ser instalado diretamente no seu sistema ou via ferramentas como o [Homebrew (macOS)](https://brew.sh/), [APT (Ubuntu)](https://ubuntu.com/) ou [YUM (CentOS)](https://www.centos.org/).
  
2. **PHP 7.x ou superior**: O PHP precisa estar instalado para executar o código do projeto. Se você não tiver o PHP instalado, pode baixá-lo no site oficial: [https://www.php.net/](https://www.php.net/).

3. **MySQL**: O banco de dados do projeto é MySQL. Certifique-se de ter o MySQL instalado em seu sistema. Para instalação, veja: [MySQL Downloads](https://dev.mysql.com/downloads/).

## Instalação

### Passo 1: Baixar o Projeto

1. **Baixe ou clone o repositório**:

   Se você está usando Git, pode clonar o repositório com o comando:

   ```bash
   git clone https://github.com/seu-usuario/construmais.git
   ```

2. **Copiar os arquivos para o diretório do seu servidor**:

   Se você está usando o Apache, copie os arquivos do projeto para o diretório `htdocs` ou qualquer diretório configurado como raiz do servidor. O caminho padrão seria:

   - **Windows (XAMPP)**: `C:\xampp\htdocs\construmais\`
   - **Linux/macOS (Apache)**: `/var/www/html/construmais/`

### Passo 2: Configuração do Banco de Dados

1. **Importar o Banco de Dados**:

   O banco de dados já está estruturado no arquivo `construmais_db.sql`. Para importar o banco de dados, siga as instruções abaixo:

   - Acesse o MySQL pelo terminal ou por um cliente como o **phpMyAdmin**.
   - Crie um novo banco de dados, por exemplo, `construmais` (se o MySQL pedir).
   - Importe o arquivo `construmais_db.sql` para o banco de dados. Se estiver usando o terminal, o comando seria:

     ```bash
     mysql -u root -p construmais < /caminho/para/o/arquivo/construmais_db.sql
     ```

     Caso esteja usando o **phpMyAdmin**, vá até a opção de **Importar** e selecione o arquivo `construmais_db.sql`.

2. **Configuração do Arquivo de Conexão**:

   O arquivo de conexão com o banco de dados é o `database.php`. Abra esse arquivo e verifique as configurações de conexão com o MySQL:

   ```php
   <?php
   // Configurações do banco de dados
   $servername = "localhost";  // Servidor do banco de dados
   $username = "root";         // Usuário do MySQL
   $password = "";             // Senha do MySQL (deixe em branco se não houver senha)
   $dbname = "construmais";    // Nome do banco de dados
   ?>
   ```

   Certifique-se de que os dados da variável `$dbname` estejam corretos e que o nome de usuário e senha do MySQL estejam adequados para o seu ambiente.

### Passo 3: Rodando o Projeto

1. **Iniciar o Servidor Web**:

   Certifique-se de que o servidor web (Apache) esteja rodando.

2. **Iniciar o MySQL**:

   Verifique se o MySQL está em funcionamento no seu sistema.

3. **Acessar o Projeto**:

   Abra o navegador e acesse:

   ```bash
   http://localhost/construmais/
   ```

   Se tudo estiver configurado corretamente, você verá a página inicial do site.

---

## Funcionalidades

- **Página Inicial**: Exibe uma introdução e destaque dos produtos.
- **Catálogo de Produtos**: Exibe todos os produtos cadastrados no banco de dados.
- **Carrinho de Compras**: Usuários podem adicionar e remover produtos do carrinho.
- **Área do Usuário**: Permite a visualização e a edição de informações da conta.
- **Cadastro e Login**: Usuários podem se registrar ou fazer login no sistema.

---

## Contribuindo

Se você deseja contribuir com o projeto, siga estas etapas:

1. **Fork este repositório**.
2. **Crie uma branch** com a sua feature (`git checkout -b feature/nova-feature`).
3. **Commit suas mudanças** (`git commit -m 'Adiciona nova feature'`).
4. **Envie para o repositório remoto** (`git push origin feature/nova-feature`).
5. **Crie um pull request**.

---

## Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---
