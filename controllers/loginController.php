<?php 
class loginController extends controller{
    public function index(){
        $dados = array();

        $this->loadView("login", $dados);
    }
}