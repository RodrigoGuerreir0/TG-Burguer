<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menu.css">
    <title>Menu</title>
</head>

<body>
    <div class="borda">
    <div class="navbar">
            <nav>
                <div class="logotipo"><img src="../imgs/Logo.png" class="logo"></div>
                <ul>
                    <li><a href="../../telaInicial.html">INÍCIO</a></li><br>
                    <li><a href="./sobre.php">SOBRE</a></li><br>
                    <li><a href="#">MENU</a></li><br>
                    <li><a href="./contatos.php">CONTATOS</a></li><br>
                    <li><a href="./perfil.php">PERFIL</a></li><br>
                    <li><a href="./login.php">LOGIN</a></li><br>
                    <li><a href="./carrinho.php">CARRINHO</a></li><br>
                </ul>
            </nav>
        </div>
        <div>
            <div class="funcionamento">
                <br>
                <br>
                <h1 class="texto">MENU</h1>
                <br>
                <br>
                <p class="parágrafo">Horário de Funcionamento:</p>
                <p class="parágrafo">Terça à Quinta - 18h30 às 23h</p>
                <p class="parágrafo">Sexta à Domingo - 18h às 00h</p>
            </div>

            <div class="cardapio-row">
                <?php
                try {
                    $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");

                    $stmt = $conexao->prepare("SELECT * FROM Estoque");
                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($result) {
                        foreach ($result as $produto) {
                ?>
                            <div class="cardapio">
                                <div class="divisoria1__cardapio">
                                    <div class="divisoria1__acima__Cardapio">
                                        <div class="lanche">
                                            <h3 class="nomeLanche"><?php echo $produto["Nome"]; ?></h3>
                                            <form action="Carrinho.php" method="post">
                                                <div class="divisoria1__cardapio-Main">
                                                        <div class="imgLanche"><img class="lancheIMG" src="<?php echo $produto["CaminhoImagem"]; ?>" alt=""></div>
                                                    <div class="descricaoLanche"><b>
                                                            <p class="txtDescricai"><?php echo $produto["Descricao"]; ?></p>
                                                        </b></div>
                                                </div>
                                                <div class="divisoria1__cardapio-BTN">
                                                    <input type="hidden" name="idLanche" value="<?php echo $produto["id"]; ?>" />
                                                    <input type="hidden" name="Nome" value="<?php echo $produto["Nome"]; ?>" />
                                                    <input type="hidden" name="Valor" value="<?php echo $produto["Valor"]; ?>" />
                                                    <input type="hidden" name="Quantidade" value="1" />

                                                    <button class="botaoLanche" type="Submit" onclick="completeOrder()">Escolher</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>





                                </div>
                            </div>
                <?php
                        }
                    }
                } catch (PDOException $e) {
                    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
                }
                ?>
            </div>
        </div>
    </div>
</body>
<script src="../js/completeOrder.js"></script>

</html>