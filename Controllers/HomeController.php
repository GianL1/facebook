<?php

namespace Controllers;

use \Core\Controller;
use \Models\Usuarios;
use \Models\Relacionamentos;
use \Models\Posts;
use \Models\Grupos;

class HomeController extends Controller {

    public function __construct(){
        $u = new Usuarios();
        $u->verificarLogin();
    }

    public function index(){
        $u = new Usuarios();
        $r = new Relacionamentos();
        $p = new Posts();
        $g = new Grupos();

        $dados = array(
            'usuario_nome' => ''
        );

        
        
        $dados['usuario_nome'] = $u->getNome($_SESSION['lgsocial']);

        if(isset($_POST['post']) && !empty($_POST['post'])) {
            $postmsg = addslashes($_POST['post']);
            $foto = array();

            if(isset($_FILES['foto']) && !empty($_FILES['foto'])) {
                $foto = $_FILES['foto'];
            }
            
            
            $p->addPost($postmsg, $foto);
        }

        if(isset($_POST['grupo']) && !empty($_POST['grupo'])) {
            $grupo = addslashes($_POST['grupo']);
            $id_grupo = $g->criar($grupo);
            header("Location: ".BASE_URL."grupos/abrir/".$id_grupo); 
        }
        
        $dados['sugestoes'] = $u->getSugestoes(3);
        $dados['requisicoes'] = $r->getRequisicoes();
        $dados['totalamigos'] = $r->getTotalAmigos();
        $dados['feed'] = $p->getFeed();
        $dados['grupos'] = $g->getGrupos();
        
        
        
        $this->loadTemplate('home', $dados);

 
    }
}