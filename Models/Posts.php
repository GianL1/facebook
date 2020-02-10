<?php 

namespace Models;
use \Core\Model;
use \Models\Relacionamentos;

class Posts extends Model {

    public function addPost($msg, $foto){
        $tipo = 'foto';
        $url = '';
        if(count($foto) > 0) {
            $tipos = array('image/jpg', 'image/png,', 'image/jpeg');

            if(in_array($foto['type'], $tipos)) {
                $tipo = 'foto';
                $url = md5(time().rand(0,99));
                switch ($foto['type']) {
                    case 'image/jpg':
                    case 'image/jpeg':
                        $url .= '.jpg';
                        break;
                    case 'image/png':
                        $url .= '.png';
                        break;
                    default:
                        
                        break;
                }
                move_uploaded_file($foto['tmp_name'],'assets/images/posts/'.$url );
            }
        }
        
        $sql = $this->pdo->prepare("INSERT INTO posts(id_usuario,data_criacao,tipo,texto,id_grupo,url) VALUES(:id_usuario,NOW(),:tipo,:msg,1,:url)");
        $sql->bindValue(":id_usuario", $_SESSION['lgsocial']);
        $sql->bindValue(":msg" , $msg);
        $sql->bindValue(":tipo" , $tipo);
        $sql->bindValue(":url" , $url);
        $sql->execute();
    }

    public function getFeed(){
        $array = array();

        $r = new Relacionamentos();
        $ids = $r->getIdsFriends();
        $ids[] = $_SESSION['lgsocial'];

        $sql = $this->pdo->prepare('SELECT *,
        (select usuarios.nome from usuarios where usuarios.id = posts.id_usuario) as nome,
        (select count(*) from post_likes where post_likes.id_post = posts.id ) as likes,
        (select count(*) from post_likes where post_likes.id_post = posts.id AND post_likes.id_usuario = :id_usuario  ) as liked
         FROM posts WHERE id_usuario IN('.implode(',',$ids).') ORDER BY data_criacao DESC');
         $sql->bindValue(":id_usuario", $_SESSION['lgsocial']);
         $sql->execute();
        

        if($sql->rowCount() > 0 ){
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function isLiked($id, $id_usuario){
        $sql = $this->pdo->prepare('SELECT * from post_likes where id_post = :id AND post_likes.id_usuario = :id_usuario');
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->execute();

        if($sql->rowCount() > 0 ){
            return true;
        }else {
            return false;
        }
    }

    public function removeLike($id, $id_usuario){
        $sql = $this->pdo->prepare("DELETE FROM post_likes WHERE id_usuario = :id_usuario AND id_post = :id_post");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->execute();
    }

    public function addLike($id, $id_usuario){
        $sql = $this->pdo->prepare("INSERT INTO post_likes(id_post,id_usuario) VALUES(:id_post,:id_usuario)");
        $sql->bindValue(":id_post", $id);
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->execute();
    }

    public function addComentario($id, $id_usuario, $txt ){
 
        $sql = $this->pdo->prepare("INSERT INTO post_comentarios(id_usuario,data_criacao,texto, id_post) VALUES(:id_usuario,NOW(),:texto,:id_post)");
        $sql->bindValue(":id_post", $id);
        $sql->bindValue(":id_usuario", $id_usuario);
        $sql->bindValue(":texto", $txt);
  
        $sql->execute();
    }
}