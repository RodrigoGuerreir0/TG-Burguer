<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Perfil</title>
</head>

<body>
    <div class="borda">
    <div class="navbar">
            <nav class="menu">
                <input type="checkbox" class="menu-faketrigger"/>
                <div class="menu_lines">
                    <!-- span é a linha que fica dentro da nave (itens) -->
                    <span></span> 
                    <span></span>
                    <span></span>
                </div>
                <ul>
                    <li><a href="../../telaInicial.html"><i class="material-symbols-outlined" >home</i>  Início</a></li>
                    <li><a href="./sobre.php"><i class="material-symbols-outlined">groups</i>  Sobre</a></li>
                    <li><a href="./menu.php"><i class="material-symbols-outlined">restaurant</i>  Menu</a></li>
                    <li><a href="./contatos.php"><i class="material-symbols-outlined">call</i>  Contatos</a></li>
                    <li><a href="#"><i class="material-symbols-outlined">perfil</i>  Pefil</a></li>
                    <li><a href="./login.php"><i class="material-symbols-outlined">login</i>  Login</a></li>
                    <li><a href="./carrinho.php"><i class="material-symbols-outlined">shopping_cart</i>  Carrinho</a></li>
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