<?php

namespace Controllers;

use \Core\Controller;
use \Models\Usuarios;

class HomeController extends Controller {

    public function __construct(){
        $u = new Usuarios();
        $u->verificarLogin();
    }

    public function index(){
        $dados = array(
            'usuario_nome' => ''
        );

        $u = new Usuarios();
        $dados['usuario_nome'] = $u->getNome($_SESSION['lgsocial']);
        $dados['sugestoes'] = $u->getSugestoes(3);
        
        $this->loadTemplate('home', $dados);
    }
}