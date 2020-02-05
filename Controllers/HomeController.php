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
        $dados = array();
        $this->loadTemplate('home', $dados);
    }
}