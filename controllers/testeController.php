<?php
class testeController extends controller{
    public function index(){
        $dados = array();
        $this->loadView('teste', $dados);
    }
}