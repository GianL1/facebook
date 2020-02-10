<?php
namespace Controllers;

use \Core\Controller;

use \Models\Usuarios;
use \Models\Grupos;

class GruposController extends Controller {

    public function abrir($id_grupo){
        $u = new Usuarios();
        $g = new Grupos();

        $dados = array(
            'usuario_nome' => $u->getNome($_SESSION['lgsocial'])
        );

        $this->loadTemplate('grupo', $dados);
    }
}