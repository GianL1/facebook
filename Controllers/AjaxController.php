<?php

namespace Controllers;

use \Core\Controller;
use \Models\Relacionamentos;
use \Models\Usuarios;
use \Models\Posts;

class AjaxController extends Controller {

    public function __construct(){
        $u = new Usuarios();
        $u->verificarLogin();
    }
    
    public function index(){
        
    }

    public function add_friend(){
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);

            $r = new Relacionamentos();
            $r->addFriend($_SESSION['lgsocial'], $id);
        }
    }

    public function aceitar_friend(){
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);

            $r = new Relacionamentos();
            $r->aceitarFriend($_SESSION['lgsocial'], $id);
        }
    }

    public function curtir(){
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);

            $p = new Posts();
            
            if($p->isLiked($id, $_SESSION['lgsocial'])) {
               
                $p->removeLiked($id, $_SESSION['lgsocial']);
            }else {
                
                $p->addLike($id, $_SESSION['lgsocial']);
            }

        }
    }

    public function comentar(){
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = addslashes($_POST['id']);
            $txt = addslashes($_POST['txt']);

            $p = new Posts();

            if(!empty($txt)) {
                $p->addComentario(intval($id),$_SESSION['lgsocial'], $txt);
            }
        }
    }
        
}