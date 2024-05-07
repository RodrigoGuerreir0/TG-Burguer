<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../PaginaInicial/css/NovaSenha.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Login - Usuário</title>

</head>

<body>
    <div class="geral">
        <div>
        <center>
            <form action="#" method="post" class="paglog">
                <img src="../../PaginaInicial/imgs/logocortado.png" class="imglogo">
                <br>
                <br>
                <div class="tamanho">
                    <section class="form-floating mb-3 ">
                        <input type="text" class="form-control" required name="usuario" id="usuarioTentativa" placeholder="Nome de Usuário">
                        <label for="usuario">Nome de usuário</label>
                    </section>
                    <section class="form-floating mb-3 ">
                        <input type="password" required name="senha" placeholder="Sua Senha" id="senhaTentativa" class="form-control" maxlength="20">
                        <label for="usuario">Sua senha</label>
                        <div id="icon" onclick="showhide()"></div>
                    </section>

                    <div class="posição"><a href="./novasenha.php" class="link">Esqueci minha senha</a></div>
                </div>
                <br>

                <button type="subimit" class="botão2">Entrar</button>
                <br>
                <br>
                <p class="p">Ainda não tem conta? <a href="../index/index.php" class="link">Cadastre-se</a></p>

            </form>
        </center>
        </div>
    </div>

    <?php
    if (isset($_POST["usuario"])) {
        $usuarioTentativa = $_POST["usuario"];
        $senhaTentativa   = $_POST["senha"];

        function validarLogin($usuarioTentativa, $senhaTentativa)
        {
            $conexao = new PDO("mysql:host=localhost;dbname=fastfood", "root", "");
            $script =   "SELECT * FROM usuario WHERE usuario ='" . $usuarioTentativa . "' AND senha ='" . $senhaTentativa . "' ";

            //var_dump($script);
            $resultado = $conexao->query($script);
            $passou = 0;
            while ($lista = $resultado->fetch()) {
                $passou++;
            }

            if ($passou > 0) {
                header("Location:../../PaginaInicial/phps/perfil.php");

                // Inicia a sessão
                session_start();

                // Supondo que $dados_usuario contenha as informações do usuário
                $_SESSION['usuario'] = $usuarioTentativa;
                $_SESSION['senha'] = $senhaTentativa;
            } else {

            }
        }

        validarLogin($usuarioTentativa, $senhaTentativa);
    }

    ?>
</body>

</html>

<script>
    const senhaTentativa = document.getElementById('senhaTentativa');
    const icon = document.getElementById('icon');

    function showhide() {
        if (senhaTentativa.type === 'password') {
            senhaTentativa.setAttribute('type', 'text');
            icon.classList.add('hide');
        } else {
            senhaTentativa.setAttribute('type', 'password');
            icon.classList.remove('hide');
        }
    }
</script>