<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/carrinho.css">
    <title>Carrinho</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<?php
require 'funcaoCarrinho.php';

$somaItens = SomaValores();
?>

<body>
    <?php

    if (isset($_POST["idLanche"], $_POST["Quantidade"], $_POST["Nome"], $_POST["Valor"])) {
        $idLanche = $_POST["idLanche"];
        $quantidade = $_POST["Quantidade"];
        $nome = $_POST["Nome"];
        $valor = $_POST["Valor"];
        $valor2 = $_POST["Valor"];

        function inserirEstoque($idLanche, $quantidade, $nome, $valor, $valor2)
        {
            $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
            $comandoSQL = $conexao->query("SELECT Quantidade, Valor, ValorDeCada FROM Carrinho " .
                " WHERE idLanche = " . $idLanche);
            $qtdeEncontrada = 0;
            $qtdeEncontrada = 0;

            while ($linhaBD = $comandoSQL->fetch()) {
                $qtdeEncontrada = $linhaBD["Quantidade"];
                $valorEncontrado = $linhaBD["Valor"];
            }


            $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
            if ($qtdeEncontrada > 0) {
                $scriptInserir = "UPDATE Carrinho SET Quantidade = :quantidade, ValorDeCada = :valordecada  WHERE idLanche = " . $idLanche;
                $stmt = $conexao->prepare($scriptInserir);

                $qtdeEncontrada = $quantidade + $qtdeEncontrada;
                $stmt->bindParam(':quantidade', $qtdeEncontrada);

                $valorEncontrado = $valor * $qtdeEncontrada;
                $stmt->bindParam(':valordecada', $valorEncontrado);
            } else {
                $scriptInserir = "INSERT INTO Carrinho (idLanche, Quantidade, Nome, Valor, ValorDeCada) VALUES (:idLanche, :quantidade, :nome, :valor, :valordecada)";
                $stmt = $conexao->prepare($scriptInserir);

                $stmt->bindParam(':idLanche', $idLanche);
                $stmt->bindParam(':quantidade', $quantidade);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':valor', $valor);
                $stmt->bindParam(':valordecada', $valor2);
            }
            $stmt->execute();
        }

        inserirEstoque($idLanche, $quantidade, $nome, $valor, $valor2);
        header('Location:menu.php');
    }

    $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
    $scriptInserir = $conexao->query("SELECT * FROM Carrinho");
    echo "<br>";
    ?>



    <?php
    try {
        $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");

        $stmt = $conexao->prepare("SELECT c.idLanche, c.Nome AS NomeCarrinho, c.Valor AS ValorCarrinho, c.Quantidade, e.Nome AS NomeEstoque, e.Valor AS ValorEstoque, e.Descricao FROM Carrinho c INNER JOIN Estoque e ON c.idLanche = e.id");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            foreach ($result as $produto) {
    ?>

    <?php
            }
        } else {
        }
    } catch (PDOException $e) {
        echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    }
    ?>





    <div class="borda">
        <div class="navbar">
            <nav>
                <div class="logotipo"><img src="../imgs/Logo.png" class="logo"></div>
                <ul>
                    <li><a href="../../telaInicial.html">INÍCIO</a></li><br>
                    <li><a href="./sobre.php">SOBRE</a></li><br>
                    <li><a href="./menu.php">MENU</a></li><br>
                    <li><a href="./contatos.php">CONTATOS</a></li><br>
                    <li><a href="./perfil.php">PERFIL</a></li><br>
                    <li><a href="./login.php">LOGIN</a></li><br>
                    <li><a href="#">CARRINHO</a></li><br>
                </ul>
            </nav>
        </div>
        <div>


            <div class="cardapio">
                <div class="divisoria1__cardapio">

                    <div class="fundoCarrinho">
                        <div class="fundoCarritho__main">
                            <div class="pedidos">
                                <div class="pedidos-main">
                                    <div>
                                        <?php
                                        $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
                                        $scriptInserir = $conexao->query("SELECT * FROM Carrinho");
                                        echo "<br>";

                                        ?>
                                        <div class="espacoTabela">
                                            <div>
                                                <table class="table">
                                                    <thead>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        while ($linha = $scriptInserir->fetch()) {
                                                            $idLanche = $linha["idLanche"];
                                                            $nome = $linha["Nome"];
                                                            $quantidade = $linha["Quantidade"];
                                                            $valor = $linha["Valor"];
                                                            $valorDeCada = $linha["ValorDeCada"];
                                                        ?>
                                                            <tr>
                                                                <td class="linhanome"><?php echo $nome; ?></td>
                                                                <td class="nome linhaquantidade quantidade" data-id="<?php echo $idLanche; ?>">
                                                                    <b>
                                                                        <button class="botaoquantmenos font" data-id="<?php echo $idLanche; ?>"><b>-</b></button>
                                                                        <span class="quantidade-atual"><?php echo $quantidade; ?></span>
                                                                        <button class="botaoquantmais font" data-id="<?php echo $idLanche; ?>"><b>+</b></button>
                                                                    </b>
                                                                </td>
                                                                <td class="nome linhavalor font"><?php echo $valorDeCada; ?></td>
                                                                <td class="ImgLixeira__main">
                                                                    <a href="excluirlanchedocarrinho.php?codigo=<?php echo $linha['id']; ?>">
                                                                        <img class="ImgLixeira" src="../imgs/Lixo.png" alt="">
                                                                    </a>
                                                                </td>
                                                                <input type="hidden" name="idLanche" value="<?php echo $idLanche; ?>">
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="naosei">
                                            <div class="MetodosPagamentos__main">

                                                <table class="teao">
                                                    <tr>
                                                        <td class="fp">Forma de Pagamento</td>
                                                    </tr>

                                                    <tr>
                                                        <td class="cc">
                                                            <label>
                                                                <input type="radio" name="radio" checked require />
                                                                <span>Cartão de Crédito</span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cc">
                                                            <label>
                                                                <input type="radio" name="radio" require />
                                                                <span>Cartão de Débito</span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cc">
                                                            <label>
                                                                <input type="radio" name="radio" require />
                                                                <span>Vale Refeição</span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cc">
                                                            <label>
                                                                <input type="radio" name="radio" require />
                                                                <span>Pix</span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <label>


                                                </table>

                                            </div>
                                            <div class="ValorPagamentos__main">
                                                <div class="numeropedido">
                                                    <div class="numeropedido__main-centro">
                                                        <div class="asofyiasd">
                                                            <p class="numeropedido__main">Numero do seu pedido</p>
                                                        </div>
                                                    </div>
                                                    <div class="numeroPDD">
                                                        <p class="numeropedido__Numero">#1407</p>
                                                    </div>

                                                </div>
                                                <p class="stpedi ">Pedido mínimo: R$0.00.</p>
                                                <p class="st">Total: <?php echo "R$ " . $somaItens  ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="subTotal">
                                    <div class="pac_main">
                                        <div class="botaoPac">
                                            <button type="submit" class="botaoPac__main"><b>Finalizar Compra</b></button>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.botaoquantmais').click(function() {
            var idLanche = $(this).attr('data-id');
            var quantidadeAtualElement = $(this).siblings('.quantidade-atual');
            var quantidadeAtual = parseInt(quantidadeAtualElement.text());

            atualizarQuantidade(idLanche, quantidadeAtual + 1, quantidadeAtualElement);
        });

        $('.botaoquantmenos').click(function() {
            var idLanche = $(this).attr('data-id');
            var quantidadeAtualElement = $(this).siblings('.quantidade-atual');
            var quantidadeAtual = parseInt(quantidadeAtualElement.text());

            if (quantidadeAtual > 1) {
                atualizarQuantidade(idLanche, quantidadeAtual - 1, quantidadeAtualElement);
            }
        });

        function atualizarQuantidade(idLanche, novaQuantidade, quantidadeElement) {
            $.ajax({
                type: 'POST',
                url: 'atualizar_quantidade.php',
                data: {
                    idLanche: idLanche,
                    novaQuantidade: novaQuantidade
                },

                success: function(response) {
                    location.reload();
                },
                
                error: function(xhr, status, error) {
                    console.log('Erro ao atualizar quantidade: ' + error);
                }
            });
        }
    });
</script>



</html>