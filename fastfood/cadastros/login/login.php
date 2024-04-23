<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Usuário</title>
    
</head>
<body>
    <div class="geral">

    <form action="#" method="post">
        <h1>Bem Vindo (a)!</h1>
        <h2>Faça seu login</h2>
        <p>Usuário:</p> 
            <input type="text" id="usuarioTentativa" name="usuario" placeholder="Digite seu usuário" >
        <p>Senha:</p>
            <input type="text" id="senhaTentativa" name="senha" placeholder="Digite sua senha" >
            <br>
            <br>
            <button type="subimit"> Entrar</button>
            <br>
            <br>
            <a href="../index/index.php">Cadastrar</a>    <a href="">Esqueci minha senha</a>
        </form>
   </div>

<?php
    if(isset($_POST["usuario"])){
         $usuarioTentativa = $_POST["usuario"];
         $senhaTentativa   = $_POST["senha"];

function validarLogin($usuarioTentativa, $senhaTentativa){
    $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
    $script =   "SELECT * FROM usuario WHERE usuario ='" . $usuarioTentativa. "' AND senha ='" . $senhaTentativa . "' ";

    //var_dump($script);
    $resultado = $conexao->query($script);
    $passou = 0;
    while($lista = $resultado->fetch()){
        $passou++;
    }

    if($passou > 0){
        header("Location:../../PaginaInicial/phps/perfil.php");
        
        
        // Inicia a sessão
        session_start();
        
        // Supondo que $dados_usuario contenha as informações do usuário
        $_SESSION['usuario'] = $usuarioTentativa;
        $_SESSION['senha'] = $senhaTentativa;

        

    } else {
        echo 'deu errado';
    }
}

validarLogin($usuarioTentativa, $senhaTentativa);
}   


?>  



        
</body>     
</html>

