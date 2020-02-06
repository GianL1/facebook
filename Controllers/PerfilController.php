<?php 

namespace Controllers;
use \Core\Controller;
use \Models\Usuarios;

class PerfilController extends Controller {
    public function __construct(){
        $u = new Usuarios();
        $u->verificarLogin();
    }

    public function index(){
        $dados = array(
            'usuario_nome' => ''
        );

        $u = new Usuarios();

        if(isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $bio = addslashes($_POST['bio']);

            $array = array(
                'nome' => $nome,
                'bio' => $bio
            );

            $u->updatePerfil($array);

            if(isset($_POST['senha']) && !empty($_POST['senha'])) {
                $senha = md5($_POST['senha']);

                $array = array(
                    'senha' => $senha
                );

                $u->updatePerfil($array);

            }
            
            header("Location: ".BASE_URL);
        }
        $dados['usuario_nome'] = $u->getNome($_SESSION['lgsocial']);
        $dados['info'] = $u->getDados($_SESSION['lgsocial']);
        $this->loadTemplate('perfil', $dados);
    }
}