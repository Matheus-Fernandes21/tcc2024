<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['nome_usuario'])) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit();
}

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "caminho_livre";

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Obtém as informações do usuário a partir do banco de dados
$sql = "SELECT nome, email, cpf, rua, numero, complemento, bairro, cidade, estado, cep FROM usuarios WHERE nome = '" . $_SESSION['nome_usuario'] . "'";
$resultado = $conn->query($sql);

// Verifica se houve erro na consulta
if (!$resultado) {
    die("Erro na consulta ao banco de dados: " . $conn->error);
}

// Obtém o registro do usuário
$usuario = $resultado->fetch_assoc();

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Caminho Livre :: Perfil do usuário</title>
        <!-- swiper css link  -->
        <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- custom css file link  -->
        <link rel="stylesheet" href="css/style.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $(".scroll-top").click(function() {
                    $("html, body").animate({ 
                        scrollTop: 0 
                    }, "slow");
                    return false;
                });
            });
        </script>
    </head>
    <body>
        <!-- header section starts  -->
        <section class="header">
   <a href="home.php" class="logo"><img src="images/logo.png"></a>
   <nav class="navbar">
      <a href="home.php" class="active">início</a>
      <a href="about.php">Sobre nós</a>
      <a href="package.php">Excursões</a>
      <a href="book.php">Agendar</a>
      
      <?php
      // Verifica se o usuário está logado
      if (isset($_SESSION['nome_usuario'])) {
         // Se o usuário estiver logado, exibe o nome e um link para a página de perfil
         echo '<a href="perfil.php">' . $_SESSION['nome_usuario'] . '</a>';
      } else {
         // Se o usuário não estiver logado, exibe os botões de Cadastro e Login
         echo '<a href="cadastro.php">Cadastro</a>';
         echo '<a href="login.php">Login</a>';
      }
      ?>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
   </nav>
   <div id="menu-btn" class="fas fa-bars"></div>
</section>
    <!-- header section ends -->
    
    <!-- profile section starts -->
    <section class="profile">
        <div class="container">
            <h1 class="heading-title">Perfil do usuário</h1>
            <div class="profile-details">
                <div class="row">
                    <div class="col">
                        <label for="nome">Nome:</label>
                        <p id="nome"><?php echo $usuario["nome"]; ?></p>
                    </div>
                    <div class="col">
                        <label for="email">E-mail:</label>
                        <p id="email"><?php echo $usuario["email"]; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="cpf">CPF:</label>
                        <p id="cpf"><?php echo $usuario["cpf"]; ?></p>
                    </div>
                    <div class="col">
                        <label for="cep">CEP:</label>
                        <p id="cep"><?php echo $usuario["cep"]; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="rua">Rua:</label>
                        <p id="rua"><?php echo $usuario["rua"]; ?></p>
                    </div>
                    <div class="col">
                        <label for="numero">Número:</label>
                        <p id="numero"><?php echo $usuario["numero"]; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="complemento">Complemento:</label>
                        <p id="complemento"><?php echo $usuario["complemento"]; ?></p>
                    </div>
                    <div class="col">
                        <label for="bairro">Bairro:</label>
                        <p id="bairro"><?php echo $usuario["bairro"]; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="cidade">Cidade:</label>
                        <p id="cidade"><?php echo $usuario["cidade"]; ?></p>
                    </div>
                    <div class="col">
                        <label for="estado">Estado:</label>
                        <p id="estado"><?php echo $usuario["estado"]; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- profile section ends -->
    
    <!-- footer section starts  -->
    <section class="footer">
        <div class="credit">desenvolvido por Grupo 7 - Sistemas de Informação - Dom Bosco</div>
    </section>
    <!-- footer section ends -->
    
    <!-- swiper js link  -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>
</html>