<?php
namespace Models;

use \Core\Model;

class Usuarios extends Model {

    public function verificarLogin(){
        
        if(!isset($_SESSION['lgsocial']) || (isset($_SESSION['lgsocial']) && !empty($_SESSION['lgsocial']))) {
            header("Location: ".BASE_URL.'login');
            
        }
        
    }

    public function logar($email, $senha){
        
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha =:senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $_SESSION['lgsocial'] = $sql['id'];

            header("Location: ".BASE_URL);
            exit;
        }else {
            return "Dados incorretos";
        }
    }

    public function cadastrar($nome, $email, $senha, $sexo){

        
        
        $sql = $this->pdo->prepare("SELECT email FROM usuarios WHERE email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return "Email já existente";
        } else {
            
            $sql = $this->pdo->prepare("INSERT INTO usuarios(nome,email,senha,sexo) VALUES(:nome,:email,:senha,:sexo)");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", $senha);
            $sql->bindValue(":sexo", $sexo);
            
            $sql->execute();

            $_SESSION['lgsocial'] = $this->pdo->lastInsertId();

            print_r($_SESSION['lgsocial']);

            header("Location: ".BASE_URL);
            exit;
        }
    }
}