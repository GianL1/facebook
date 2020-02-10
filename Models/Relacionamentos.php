<?php 

namespace Models;

use \Core\Model;

class Relacionamentos extends Model {


    public function addFriend($id1, $id2){
        $sql = $this->pdo->prepare("INSERT INTO relacionamentos(usuario_de,usuario_para, status) VALUES(:id1,:id2, 0)");
        $sql->bindValue(":id1", $id1);
        $sql->bindValue(":id2", $id2);
        $sql->execute();
    }

    public function aceitarFriend($id1, $id2){
        $sql = $this->pdo->prepare("UPDATE relacionamentos SET status = 1 WHERE usuario_de = :id2 AND usuario_para = :id1");
        $sql->bindValue(":id1", $id1);
        $sql->bindValue(":id2", $id2);
        $sql->execute();
    }

    public function getRequisicoes() {
        $array = array();

        $sql = $this->pdo->prepare('SELECT usuarios.id, usuarios.nome 
        FROM relacionamentos
        LEFT JOIN usuarios 
        ON usuarios.id = relacionamentos.usuario_de
        WHERE relacionamentos.usuario_para = :id_usuario 
        AND relacionamentos.status = 0');

        $sql->bindValue(":id_usuario", $_SESSION['lgsocial']);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
             
        }
        return $array;
    }

    public function getTotalAmigos(){
        $sql = $this->pdo->prepare("SELECT COUNT(*) as c FROM relacionamentos WHERE (usuario_de = :id OR usuario_para = :id) AND status = 1");
        $sql->bindValue(":id", $_SESSION['lgsocial']);
        $sql->execute();

        
        $sql = $sql->fetch();
        return $sql['c'];
        
    }

    public function getIdsFriends(){
        $array = array();
        $sql = $this->pdo->prepare("SELECT * FROM relacionamentos WHERE (usuario_de = :id OR usuario_para = :id)  AND status = 1");
        $sql->bindValue(":id", $_SESSION['lgsocial']);
        $sql->execute();

        if($sql->rowCount() > 0) {
            foreach($sql->fetchAll() as $ritem) {
                $array[] = $ritem['usuario_de'];
                $array[] = $ritem['usuario_para'];
            }
        }
        return $array;
    }

}
