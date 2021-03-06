<?php 

namespace Controllers;

use \Core\Controller;

use \Models\Usuarios;


class BuscaController extends Controller {

    public function __construct(){
        $u = new Usuarios();
        $u->verificarLogin();

        
    }

    public function index(){

        $u = new Usuarios();

        $dados = array(
            'usuario_nome' => ''
        );

        $dados['usuario_nome'] = $u->getNome($_SESSION['lgsocial']);
        $dados['resultado'] = $u->procurar($_GET['q']);

        
        $this->loadTemplate('busca', $dados);
    }
}