
<?php
function alterar(){
    session_start();
                $conexao = new PDO("mysql:host=127.0.0.1;dbname=fastfood", "root", "");
                $usuario =  $_SESSION['usuario'];
               
                $sql = "SELECT * FROM usuario WHERE usuario = '$usuario'";
                $result = $conexao->query($sql);
                $registro = $result->fetch();

               echo ' <form action="./php do perfil/alterar.php" method="post">';
               echo '<input type="hidden" name="id" value="'.$registro['codigo'].'">';
               
               echo '<label for="nome">Nome :</label>';
               echo '<input type="text" id="nome" name="nome" value="'.$registro['nome'].'"><br/>';

               echo '<label for="email">Email :</label>';
               echo '<input type="email" id="email" name="email" value="'.$registro['email'].'"><br/>';

               echo '<label for="telefone">telefone :</label>';
               echo '<input type="text" id="telefone" name="telefone" value="'.$registro['telefone'].'"><br/>';

               echo '<label for="endereco">Endereço :</label>';
               echo '<input type="text" id="endereco" name="endereco" value="'.$registro['endereco'].'"><br/>';
               
           
               echo '<label for="senha">Senha :</label>';
               echo '<input type="text" id="senha" name="senha" value="'.$registro['senha'].'"><br/>';
            
               echo '<input type="submit" value="Salvar">';
               echo '</form>'; 
               
            
            }
alterar();
            ?>