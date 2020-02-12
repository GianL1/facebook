<?php 

namespace Models;

use \Core\Model;

class Grupos extends Model {

    public function getGrupos(){
        $array = array();

        $sql = $this->pdo->query("SELECT id, titulo FROM grupos");

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function criar($titulo){
        $sql = $this->pdo->prepare("INSERT INTO grupos(id_usuario,titulo) VALUES(:id_usuario,:titulo)");
        $sql->bindValue(":id_usuario", $_SESSION['lgsocial']);
        $sql->bindValue(":titulo", $titulo);
  
        $sql->execute();
        $id = $this->pdo->lastInsertId();

        $sql = $this->pdo->prepare("INSERT INTO grupos_membros(id_usuario,id_grupo) VALUES(:id_usuario,:id_grupo)");
        $sql->bindValue(":id_usuario", $_SESSION['lgsocial']);
        $sql->bindValue(":id_grupo", $id);

        $sql->execute();

        return $id;
    }

    public function getInfo($id_grupo){
        $array = array();

        $sql = $this->pdo->prepare("SELECT * FROM grupos WHERE id = :id_grupo");
        $sql->bindValue(":id_grupo", $id_grupo);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }
        return $array;
    }

    public function isMembro($id_grupo, $id_usuario){
        $sql = $this->pdo->prepare("SELECT * FROM grupos_membros WHERE id_grupo = :id_grupo AND id_usuario = :id_usuario");
        $sql->bindValue(":id_usuario", $_SESSION['lgsocial']);
        $sql->bindValue(":id_grupo", $id_grupo);
        $sql->execute();

        if($sql->rowCount() > 0) {
            return true;
        }else {
            return false;
        }
    }

    public function getQuantMembros($id_grupo){
        $sql = $this->pdo->prepare("SELECT COUNT(*) as c FROM grupos_membros WHERE id_grupo = :id_grupo");
        $sql->bindValue("id_grupo", $id_grupo);
        $sql->execute();
        $sql = $sql->fetch();

        return $sql['c'];
    }

    public function addMembro($id_grupo, $id_usuario){
        $sql = $this->pdo->prepare("INSERT INTO grupos_membros(id_usuario,id_grupo) VALUES(:id_usuario,:id_grupo)");
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->bindValue(":id_grupo",$id_grupo);
        $sql->execute();
    }
}