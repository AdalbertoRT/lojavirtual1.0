<?php
class homeController extends controller{
    
    public function index() {
        $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';
        $dados = array();
        $produtos = new Produto();
        $dados['produtos'] = $produtos->listar($filtro, 10);
        $dados['categoria'] = new Produto();

        $this->loadTemplate('home', $dados);

    }
}