<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Perfil</title>
</head>

<body>
    <div class="borda">
        <div class="navbar">
            <nav>
                <div class="logotipo"><img src="../imgs/Logo.png" class="logo"></div>
                <ul>
                    <li><a href="../../telaInicial.html">INÍCIO</a></li><br>
                    <li><a href="./sobre.php">SOBRE</a></li><br>
                    <li><a href="./menu.php">MENU</a></li><br>
                    <li><a href="./contatos.php">CONTATOS</a></li><br>
                    <li><a href="#">PERFIL</a></li><br>
                    <li><a href="./login.php">LOGIN</a></li><br>
                    <li><a href="./carrinho.php">CARRINHO</a></li><br>
                </ul>
            </nav>

        </div>



        <div class="textoCentral">
            <?php

session_start();
            $usuario =  $_SESSION['usuario'];
            echo "<br>";
            echo "<br>";
            echo "<br>";

            $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");
            $comandoSQL = $conexao->query("SELECT * FROM usuario where usuario = '$usuario'");

            while ($linhaBD = $comandoSQL->fetch()) {
                
                echo 'nome: ' . $linhaBD["nome"] . '<br/>';
                echo 'email: ' . $linhaBD["email"] . '<br/>';
                echo 'cpf: ' . $linhaBD["cpf"] . '<br/>';
                echo 'endereco: ' . $linhaBD["endereco"] . '<br/>';
                echo 'telefone: ' . $linhaBD["telefone"] . '<br/>';
                echo 'usuario: ' . $linhaBD["usuario"] . '<br/>';


                $nome = $linhaBD["nome"];
                $email = $linhaBD["email"];
                $cpf = $linhaBD["cpf"];
                $telefone = $linhaBD["telefone"];
                $endereco = $linhaBD["endereco"];
            }

            function sair(){
                session_destroy();
                header("location:perfil.php");

            }
          // Chamar a função se não estiver usando o botão submit
            if (isset($_POST['button'])) {
                
                sair();
                
            }
          


            ?>
  </div>
      
        <div>
            <form action="PuxarAlteracao.php" method="post">
                <button name="button" type="submit">Alterar</button>
            </form>
           
            <form action="#" method="post">
                <button name="button"  type="submit">Sair</button>
            </form>
>
           
</div>
</body>
</html>