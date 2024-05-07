<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Seu Pedido</title> -->
</head>

<!-- SE QUISER USAR ESSE ESTILO COMO BASE PODE USAR -->

<!-- <style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        list-style: none;
    }

    body {
        width: 100%;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.637);
        justify-content: center;
        align-items: center;
        display: flex;
        min-height: 100vh;
        height: auto;
    }

    .borda {
        border: 0.7vh rgb(34, 32, 32);
        width: 203vh;
        height: auto;
        min-height: 98vh;
        border-radius: 7vh;
        box-shadow: 0.7vh 0.7vh 2.5vh 0.3vh #0000008a;
        background-color: rgb(0, 0, 0);
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }

    .titulo {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 3vh;
    }

    .title-txt {
        font-size: 6vh;
        color: rgb(255, 145, 0);
        font-family: "Changa One", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

    .pedido-info {
        margin-top: 20px;
        color: white;
    }

    .pedido-info p {
        margin-bottom: 10px;
    }

    .pedido-info h1 {
        font-size: 2.5rem;
        color: #F8AF29;
        margin-bottom: 20px;
    }
</style> -->

<body>
    <div class="borda">
        <!-- <div class="titulo">
            <h1 class="title-txt">Seu Pedido</h1>
        </div> -->
        <div class="pedido-info">

            <?php
            $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");

            if (isset($_POST["NumeroPedido"])) {
                $NumeroPedido = $_POST["NumeroPedido"];
                $metodopagamento = $_POST["MetodoPagamento"];

                $scriptInserir = "UPDATE Carrinho SET Processamento = 1, NumeroPedido = :numeropedido, MetodoPagamento = :metodopagamento WHERE Processamento = 0";
                $stmt = $conexao->prepare($scriptInserir);
                $stmt->bindParam(':numeropedido', $NumeroPedido);
                $stmt->bindParam(':metodopagamento', $metodopagamento);
                $stmt->execute();
            }

            $conexaoPedidos = $conexao->prepare("SELECT * FROM Carrinho WHERE Processamento = 1 AND NumeroPedido = :numeropedido");
            $conexaoPedidos->bindParam(':numeropedido', $NumeroPedido);
            $conexaoPedidos->execute();

            ?>

            <?php if (isset($NumeroPedido)) { ?>
                <h1>Seu Pedido #<?php echo $NumeroPedido; ?></h1>
            <?php } else { ?>
                <p>Número do pedido não encontrado.</p>
            <?php } ?>

            <?php
            $result = $conexaoPedidos->fetchAll(PDO::FETCH_ASSOC);
            $primeiraVez = true;
            if ($result) {
                foreach ($result as $linhaBD) {
                    if ($primeiraVez) {
            ?>
                        <p><?php echo $linhaBD["Nome"]; ?></p>
                        <p><?php echo $linhaBD["Quantidade"]; ?></p>
                        <p><?php echo $linhaBD["ValorDeCada"]; ?></p>
                        <p><?php echo $linhaBD["MetodoPagamento"]; ?></p>
                    <?php
                        $primeiraVez = false;
                    } else {
                    ?>
                        <p><?php echo $linhaBD["Nome"]; ?></p>
                        <p><?php echo $linhaBD["Quantidade"]; ?></p>
                        <p><?php echo $linhaBD["ValorDeCada"]; ?></p>
            <?php
                    }
                }
            } else {
                echo "<p>Nenhum pedido encontrado.</p>";
            }
            ?>
        </div>
        <?php

        if ($stmt->execute()) {
            $consultaLanches = $conexao->prepare("SELECT idLanche, Quantidade FROM Carrinho WHERE Processamento = 1 AND NumeroPedido = :numeropedido");
            $consultaLanches->bindParam(':numeropedido', $NumeroPedido);
            $consultaLanches->execute();

            while ($linha = $consultaLanches->fetch(PDO::FETCH_ASSOC)) {
                $idLanche = $linha['idLanche'];
                $quantidadeComprada = $linha['Quantidade'];

                $consultaEstoque = $conexao->prepare("SELECT Quantidade FROM Estoque WHERE id = :idLanche");
                $consultaEstoque->bindParam(':idLanche', $idLanche);
                $consultaEstoque->execute();

                $linhaEstoque = $consultaEstoque->fetch(PDO::FETCH_ASSOC);
                $quantidadeAtual = $linhaEstoque['Quantidade'];

                $novaQuantidade = $quantidadeAtual - $quantidadeComprada;

                $atualizaEstoque = $conexao->prepare("UPDATE Estoque SET Quantidade = :novaQuantidade WHERE id = :idLanche");
                $atualizaEstoque->bindParam(':novaQuantidade', $novaQuantidade);
                $atualizaEstoque->bindParam(':idLanche', $idLanche);
                $atualizaEstoque->execute();
            }
        }

        ?>

    </div>
</body>

</html>