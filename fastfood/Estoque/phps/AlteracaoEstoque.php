<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/AlteracaoEstoque.css">
    <title>Atualizações no Estoque</title>
</head>

<body>
    <div class="divisoria1">
        <div class="title__geral">
        <h2>Últimas Atualizações no Estoque</h2>
        </div>
        <div class="Fundo__main">
        <?php
        try {
            $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");

            $stmt = $conexao->prepare("SELECT * FROM Estoque ORDER BY DataModificacao DESC LIMIT 10");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result) {
                foreach ($result as $produto) {
        ?>
                    <div class="Fundo">
                        <div class="">
                            <div class="codigo-Barras__Main">
                                <h2 class="codigo-Barra">Código de Barras: <?php echo $produto["Codigo"]; ?></h2>
                            </div>
                            <div class="Modificacoes">
                                <p class="Nome__main-geral">Nome: <span class="Resposta__Nome"><b><?php echo $produto["Nome"]; ?></b></span></p>
                                <p class="Nome__main-geral">Quantidade no Estoque: <span class="Resposta__Nome"><b><?php echo $produto["Quantidade"]; ?></b></span></p>
                                <p class="Nome__main-geral">Última Modificação: <span class="Resposta__Nome"><b><?php echo $produto["DataModificacao"]; ?></b></span></p>
                            </div>
                        </div>
                    </div>
        <?php
                }
            } else {
                echo "Nenhum produto foi alterado recentemente.";
            }
        } catch (PDOException $e) {
            echo "Erro na conexão com o banco de dados: " . $e->getMessage();
        }
        ?>
    </div>
    
    </div>
    <div class="divisoria2">
            <div class="botaoVoltar__main">
                <a class="linkVoltar" href="../inicio.html"><button class="botaoVoltar"> < </button></a>
             </div>
        </div>
</body>

</html>
