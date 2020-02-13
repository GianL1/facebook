<?php 
namespace Controllers;

use \Core\Controller;

use \Models\Usuarios;
use \Models\Grupos;
use \Models\Posts;

class GruposController extends Controller {

    public function abrir($id_grupo = '0'){
        $u = new Usuarios();
        $g = new Grupos();
        $p = new Posts();

        $dados = array(
            'usuario_nome' => $u->getNome($_SESSION['lgsocial'])
        );

        if(isset($_POST['post']) && !empty($_POST['post'])) {
            $postmsg = addslashes($_POST['post']);
            $foto = array();

            if(isset($_FILES['foto']) && !empty($_FILES['foto'])) {
                $foto = $_FILES['foto'];
            }
            
            
            $p->addPost($postmsg, $foto, $id_grupo);
        }

        $dados['info'] = $g->getInfo($id_grupo);
        $dados['id_grupo'] = $id_grupo;
        $dados['is_membro'] = $g->isMembro($id_grupo, $_SESSION['lgsocial']);
        $dados['qt_membros'] = $g->getQuantMembros($id_grupo);
        $dados['feed'] = $p->getFeed($id_grupo);

        $this->loadTemplate('grupo', $dados);
    }

    public function entrar($id_grupo){
        
        $g = new Grupos();
        $g->addMembro($id_grupo, $_SESSION['lgsocial']);

        header("Location: ".BASE_URL."grupos/abrir/". $id_grupo);
    }
}