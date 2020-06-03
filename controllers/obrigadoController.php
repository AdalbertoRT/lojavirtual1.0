<?php
class obrigadoController extends controller{
    
    public function index() {
        
        $dados = array();

        $this->loadTemplate('obrigado', $dados);

    }
}