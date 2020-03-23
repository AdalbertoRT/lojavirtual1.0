<?php
class erro404Controller extends controller{
    public function index(){
        $dados = array();
        return $this->loadTemplate("erro404", $dados);
    }
}