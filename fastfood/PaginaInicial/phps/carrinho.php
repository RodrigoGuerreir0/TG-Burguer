<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/carrinho.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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

        $processamento = 0;


        function inserirEstoque($idLanche, $quantidade, $nome, $valor, $valor2, $processamento)
        {
            $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
            $comandoSQL = $conexao->query("SELECT Quantidade, Valor, ValorDeCada FROM Carrinho " .
                " WHERE idLanche = " . $idLanche . " AND processamento = 0");

            $qtdeEncontrada = 0;

            while ($linhaBD = $comandoSQL->fetch()) {
                $qtdeEncontrada = $linhaBD["Quantidade"];
                $valorEncontrado = $linhaBD["Valor"];
            }

            $numpedido = 0;
            $metodopagamento = 'vazio';

            if ($qtdeEncontrada > 0) {
                $scriptInserir = "UPDATE Carrinho SET Quantidade = :quantidade, ValorDeCada = :valordecada, NumeroPedido = :numeropedido, MetodoPagamento = :metodopagamento WHERE Processamento = 0 AND idLanche = " . $idLanche;
                $stmt = $conexao->prepare($scriptInserir);

                $qtdeEncontrada = $quantidade + $qtdeEncontrada;
                $stmt->bindParam(':quantidade', $qtdeEncontrada);

                $valorEncontrado = $valor * $qtdeEncontrada;
                $stmt->bindParam(':valordecada', $valorEncontrado);
                $stmt->bindParam(':numeropedido', $numpedido);
                $stmt->bindParam(':metodopagamento', $metodopagamento);
            } else {
                $scriptInserir = "INSERT INTO Carrinho (idLanche, Quantidade, Nome, Valor, ValorDeCada, Processamento, NumeroPedido, MetodoPagamento) VALUES (:idLanche, :quantidade, :nome, :valor, :valordecada, :processamento, :numeropedido, :metodopagamento)";
                $stmt = $conexao->prepare($scriptInserir);

                $stmt->bindParam(':idLanche', $idLanche);
                $stmt->bindParam(':quantidade', $quantidade);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':valor', $valor);
                $stmt->bindParam(':valordecada', $valor2);
                $stmt->bindParam(':processamento', $processamento);
                $stmt->bindParam(':numeropedido', $numpedido);
                $stmt->bindParam(':metodopagamento', $metodopagamento);
            }
            $stmt->execute();
        }

        inserirEstoque($idLanche, $quantidade, $nome, $valor, $valor2, $processamento, $Numeropedido);
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
                    <li><a href="./perfil.php"><i class="material-symbols-outlined">perfil</i>  Pefil</a></li>
                    <li><a href="./login.php"><i class="material-symbols-outlined">login</i>  Login</a></li>
                    <li><a href="#"><i class="material-symbols-outlined">shopping_cart</i>  Carrinho</a></li>
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
                                        $scriptInserir = $conexao->query("SELECT * FROM Carrinho where processamento = 0");
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
                                                <form action="pedidos.php" method="post">
                                                    <table class="teao">
                                                        <tr>
                                                            <td class="fp">Forma de Pagamento</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="cc">
                                                                <label>
                                                                    <input type="radio" checked require name="MetodoPagamento" value="Cartão de Crédito" />
                                                                    <span name="MetodoPagamento">Cartão de Crédito</span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="cc">
                                                                <label>
                                                                    <input type="radio" require name="MetodoPagamento" value="Cartão de Débito" />
                                                                    <span name="MetodoPagamento">Cartão de Débito</span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="cc">
                                                                <label>
                                                                    <input type="radio" require name="MetodoPagamento" value="Vale Refeição" />
                                                                    <span>Vale Refeição</span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="cc">
                                                                <label>
                                                                    <input type="radio" require name="MetodoPagamento" value="Pix" />
                                                                    <span>Pix</span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                        <label>

                                                    </table>
                                                    <input type="hidden" name="NomeLanche" value="<?php echo $nome; ?>"> </input>
                                                    <input type="hidden" name="QuantidadeLanche" value="<?php echo $quantidade; ?>"></input>
                                                    <input type="hidden" name="ValorPedido" value="<?php echo $somaItens; ?>"></input>

                                            </div>

                                            <div class="ValorPagamentos__main">
                                                <div class="numeropedido">
                                                    <div class="numeroPDD">
                                                        <p class="numeropedido__main">Numero do seu pedido será gerado após finalizar seu pedido</p>

                                                    </div>
                                                </div>
                                                <p class="stpedi ">Pedido mínimo: R$0.00.</p>
                                                <p class="st" name="ValorPedido">Total: <?php echo "R$ " . $somaItens  ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="subTotal">
                                    <div class="pac_main">
                                        <div class="botaoPac">

                                            <?php
                                            $Numeropedido = intval(rand(1, 9999));


                                            ?>

                                            <input type="hidden" name="NumeroPedido" value="<?php echo $Numeropedido  ?>"></input>

                                            <button type="submit" class="botaoPac__main" target="_blank" ><b>Finalizar Compra</b></button>
                                        </div>

                                    </div>
                                </div>
                                </form>

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