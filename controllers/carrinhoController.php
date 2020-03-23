<?php
class carrinhoController extends controller{

    public function index(){
        $dados = array();
        if(isset($_SESSION['carrinho'])){
            $carrinho = new Carrinho;
            $dados['carrinho'] = $carrinho->listar($_SESSION['carrinho']);
            $dados['cat'] = new Produto();

            return $this->loadTemplate("carrinho", $dados);
        }
        
        return $this->loadTemplate("carrinho", $dados);
    }

    public function add($id){
        if(!empty($id)){
            $p = new Produto();
            if($p->prodExists($id)){
                if(!isset($_SESSION['carrinho'])){
                    $_SESSION['carrinho'] = array();
                }
                if(in_array($id, $_SESSION['carrinho'])){
                   $item = array("item" => $id);
                   $_SESSION['carrinho'] = array_diff($_SESSION['carrinho'], $item);
                }
                
                array_push($_SESSION['carrinho'], $id);
                
                header("Location: ".BASE_URL."carrinho");
            }
        }
    }
}