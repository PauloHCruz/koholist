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

    //verificar se os campos estão preenchidos
    if(!empty($nome) && !empty($email) && !empty($senha)){
        $u->conectar("koholist","localhost","root","");
        if($u->msgErro==""){// se estiver certo
            if($senha==$confirmarsenha){
                if($u->cadastrar($nome,$email,$senha)){
                    echo "Usuario cadastrado com sucesso";
                }
                else{
                    echo "Este usuario já existe";
                }
            }
            else
            {
                echo "senha e confirmar senha não correspondem";
            }
        }
        else{
            echo "Erro:".$u->msgErro;
        }
    }
    else{
        echo "Preencha todos os campos";
    }
}
?>