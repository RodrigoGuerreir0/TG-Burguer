<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Estoque.css">
    <title>Estoque</title>
</head>

<body>
    <div class="divisoria1">
    <form action="./ValidarEstoque.php" method="POST">
        <div class="Codigo">
            <label for="">Codigo:</label>
            <input type="text" class="" name="codigo" placeholder="Codigo do produto:">
        </div>
        
        <div class="NomeProduto">
            <label for="">Nome do Produto</label>
            <input type="text" class="" name="nome" placeholder="Nome do produto:">
        </div>

        <div class="Categorias">
            <label for="">Categoria</label>
            <select class="" name="categorias">
                <option value="">Selecione uma categoria</option>
                <option value="Lanche">Lanche</option>
                <option value="Bebida">Bebida</option>
                <option value="Porção">Porção</option>
            </select>
        </div>

        <div class="Valor">
            <label for="">Valor:</label>
            <input type="text" class="" name="valor" placeholder="Valor do produto:">
        </div>

        <div class="Quantidade">
            <label for="">Quantidade:</label>
            <input type="text" class="" name="quantidade" placeholder="Quantidade do produto:">
        </div>

        <div class="Quantidade">
            <label for="">Caminho Imagem:</label>
            <input type="text" class="" name="caminhoimagem" placeholder="Caminho Imagem:">
        </div>

        <div class="Descricao">
            <label for="">Descrição:</label>
            <input type="text" class="" name="descricao" placeholder="Descrição do produto:">
        </div>

        <div class="botao-Enviar">
            <input type="submit" value="Enviar Produto">
        </div>
    
    </form>
    </div>
    <div class="divisoria2">
            <div class="botaoVoltar__main">
                <a class="linkVoltar" href="../inicio.html"><button class="botaoVoltar"> < </button></a>
             </div>
        </div>
</body>

</html>