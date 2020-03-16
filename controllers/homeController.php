<?php
class homeController extends controller{
    
    public function index() {
        $dados = array();
        $produtos = new Produto();
        $dados['produtos'] = $produtos->listar(10);
        $dados['categoria'] = new Produto();

        $this->loadTemplate('home', $dados);

    }
}