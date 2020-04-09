<?php
class finalizarController extends controller{
    public  function index(){
        $dados = array();
        if(isset($_SESSION["logado"])){
            if(isset($_SESSION['carrinho'])){
                $carrinho = new Carrinho;
                $dados['carrinho'] = $carrinho->listar($_SESSION['carrinho']);
                $dados['cat'] = new Produto();
                $pagamentos = new Pagamentos();
                $dados['pagamentos'] = $pagamentos->getPagamentos();
            }
        }else{
            header("Location: ".BASE_URL."login");
        }
        
        $this->loadTemplate("finalizar", $dados);
    }
    
}