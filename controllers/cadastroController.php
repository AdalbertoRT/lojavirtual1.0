<?php 
class cadastroController extends controller{
    public function index(){
        $dados = array();

        return $this->loadView("cadastro", $dados);
    }
}