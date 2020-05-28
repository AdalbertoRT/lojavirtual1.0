<?php
class finalizarController extends controller{
    public  function index(){
        $dados = array();
        if(isset($_SESSION["logado"])){
            if(isset($_SESSION['carrinho'])){
                
                $carrinho = new Carrinho;
                $ids = array();
                foreach($_SESSION['carrinho'] as $item){
                    if(!is_array($item)){
                        array_push($ids, $item);
                    }
                }
                $dados['carrinho'] = $carrinho->listar($ids);
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