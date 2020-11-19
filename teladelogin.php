<?php
  require_once 'classes/usuarios.php';
  $u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koholist - Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="login-container">
        <h1>Login</h1>
        <form method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Digite seu E-mail" autocomplete="off">
            <label for="password">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="Digite sua senha" autocomplete="off">
            <a href="#" id="esqueceu-senha">Esqueci minha senha</a>
            <input type="submit" value="Login">
        </form>

        
        <div id="registro-container">
            <p>Crie sua conta:</p>
            <a href="teladecadastro.php" id="resgistrar">Cadastrar</a>
        </div>

        <?php 
            if(isset($_POST['email'])){
                $email = addslashes($_POST['email']);
                $senha = addslashes($_POST['senha']);
                
                if(!empty($email) && !empty($senha)){
                    $u->conectar("koholist","127.0.0.1:3308","root","");
                              
                    if($u->msgErro==""){
                        if($u->logar($email,$senha)){
                            header("location:telainicial.php");
                        }
                        else{
                            ?>
                            <div class="msg_erro">
                                Email e/ou senha estão incorretos!
                            </div>    
                            <?php
                        }
                    }
                    else{
                        echo "Erro:".$u->msgErro;
                    }
                }
            }
            else{
                ?>
            <div class="msg_erro">
                Preencha todos os campos!
            </div>
            <?php
            }    
        ?>

    </div>
</body>
</html>