<?php
namespace Models;

use \Core\Model;
use \Models\Relacionamentos;

class Usuarios extends Model {

    public function verificarLogin(){
        
        if(!isset($_SESSION['lgsocial']) || (isset($_SESSION['lgsocial']) && empty($_SESSION['lgsocial']))) {
            header("Location: ".BASE_URL.'login');
            
        }
        
    }

    public function logar($email, $senha){
        
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha =:senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", md5($senha));
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


            header("Location: ".BASE_URL);
            exit;
        }
    }

    public function getNome($id) {
        $sql = $this->pdo->prepare("SELECT nome FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            $sql = $sql->fetch();
            return $sql['nome'];
        }
    }

    public function getDados($id){
        $array = array();

        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0)
        {
            $array = $sql->fetch();
            return $array;
        }
    }

    public function updatePerfil($array){
        if(count($array) > 0) {
            $sql = "UPDATE usuarios SET ";

            $campos = array();
            foreach ($array as $campo => $valor) {
                $campos[] = $campo." = '".$valor."'";

            }

            $sql .= implode(",", $campos);
            $sql .= " WHERE id = '".($_SESSION['lgsocial'])."'";
            
            $sql = $this->pdo->query($sql);
        }
        
    }

    public function getSugestoes($limit = 2){
        $array = array();

        $r = new Relacionamentos();
        $ids = $r->getIdsFriends();

        if(count($ids) > 0) {
            $ids[] = $_SESSION['lgsocial'];
        }
        
        $sql = $this->pdo->prepare("SELECT usuarios.id, usuarios.nome 
        FROM usuarios
        WHERE usuarios.id != :meuid AND
        usuarios.id NOT IN (".implode(',', $ids).")
        ORDER BY RANDOM() 
        LIMIT $limit" );

        $sql->bindValue(":meuid", $_SESSION['lgsocial']);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function addFriend($id1, $id2){
        $sql = $this->pdo->prepare("INSERT INTO relacionamentos(usuario_de,usuario_para, status) VALUES(:id1,:id2, 0)");
        $sql->bindValue(":id1", $id1);
        $sql->bindValue(":id2", $id2);
        $sql->execute();
    }

    public function procurar($q){
        $array = array();

        $q = addslashes($q);

        $sql = $this->pdo->query("SELECT * FROM usuarios WHERE nome LIKE '%$q%'");

        if($sql->rowCount() > 0)
        {
            $array = $sql->fetchAll();
        }

        return $array;
    }
}