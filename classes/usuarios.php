<?php 

class usuario
{
    private $pdo;
    public $msgErro="";
    public function conectar($dbnome,$host,$usuario,$senha){
        global $pdo;
        try{
            $pdo = new PDO("mysql:dbname=".$dbnome.";host=".$host,$usuario,$senha);
        }catch (PDOException $e){
            $msgErro = $e->getMessage();
            throw new PDOException($e);
        }
        

    }

    public function cadastrar($nome,$email,$senha){
        global $pdo;
        //verificar se o usuário já está cadastrado (verificando se for retornado o id_usuario)
        $sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email=:e");
        $sql->bindValue(":e",$email);
        $sql->execute();
        if($sql->rowCount()>0){
            return false;//usuário já cadastrdo
        }
        else{
            //caso não esteja, realizar cadastro
            $sql = $pdo->prepare("INSERT INTO usuario (nome,email,senha) VALUES (:n, :e, :s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",$senha);
            $sql->execute();
            return true;//cadastrado com sucesso
        }

        
    }
    public function logar($email,$senha){
        global $pdo;
        //verificar se o email e senha estão cadatrados no bando de dados
        $sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email=:e AND senha =:s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",$senha);
        $sql->execute();
        if($sql->rowCount()>0){
            //entrar no sitema(sessão)
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_usuario']=$dado['id_usuario'];
            return true;//logado com sucesso
        }
        else{
            return false; //não foi possivel logar
        }

    }
}

?>