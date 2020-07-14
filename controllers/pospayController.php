<?php
class pospayController extends controller{
    public function index(){
        $dados = array();
        $this->loadView('pospay', $dados);
    }
}