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

        return $this->pdo->lastInsertId();
    }
}