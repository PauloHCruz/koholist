<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koholist - Cadastro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="icones/favicon.ico" type="image/x-icon">
</head>
<body>
    <div id="login-container">
        <h1>Cadastro</h1>
        <form method="POST">
            <label for="text">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="Digite seu nome" autocomplete="off" maxlength="40">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Digite seu E-mail" autocomplete="off" maxlength="">
            <label for="password">Senha</label>
            <input type="password" name="senha" id="senha" placeholder="Digite sua senha" autocomplete="off">
            <label for="password">Confirmar Senha</label>
            <input type="password" name="confirmarsenha" id="confirmarsenha" placeholder="Digite sua senha novamente" autocomplete="off">
            <label for="password">Insira sua foto</label>
            <input type="file" name="foto[]" multipled id="foto">
            <input type="submit" value="Cadastrar">
        </form>
        
        <div id="registro-container">
            <p>Entre em sua conta:</p>
            <a href="teladelogin.php" id="logar">Login</a>
        </div>
    </div>


    <?php 
    //instanciando a classe usuarios
    require_once 'classes/usuarios.php';
    $u = new usuario;
    //verificar se a pessoa clicou no botão
    if(isset($_POST['nome'])){
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confirmarsenha = addslashes($_POST['confirmarsenha']);
        
        $fotos = array();
        if(isset($_FILES['foto']))
        {
            $nome_foto = $_FILES['foto']['name'][0];
            move_uploaded_file($_FILES['foto']['tmp_name'][0],'upload-fotos/'.$nome_foto);
            array_push($fotos,$nome_foto);
        }

        //verificar se os campos estão preenchidos
        if(!empty($nome) && !empty($email) && !empty($senha)){
            $u->conectar("koholist","127.0.0.1:3308","root","");
            if($u->msgErro==""){// se estiver certo
                if($senha==$confirmarsenha){
                    if($u->cadastrar($nome,$email,$senha,$fotos)){
                        ?>
                        <div id="msg_sucesso">
                            Usuario cadastrado com sucesso!
                        </div>
                        <?php
                    }
                    else{
                        ?>
                        <div class="msg_erro">
                            Este usuario já existe!
                        </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <div class="msg_erro">
                    <?php echo "senha e confirmar senha não correspondem";?>
                    </div>
                    <?php
                }
            }
            else{
                echo "Erro:".$u->msgErro;
            }
        }
        else{
            ?>
            <div class="msg_erro">
                Preencha todos os campos!
            </div>
            <?php
        }
    }
    ?>
</body>
</html>
