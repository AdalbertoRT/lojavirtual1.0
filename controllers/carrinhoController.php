<?php
class carrinhoController extends controller{

    public function index(){
        //  unset($_SESSION['carrinho']);
    //   var_dump($_SESSION['carrinho']);exit;
        $dados = array();

        if(isset($_SESSION['carrinho'])){
            // print_r($_SESSION['carrinho']);exit;
            $carrinho = new Carrinho();
            $ids = array();
            foreach($_SESSION['carrinho'] as $item){
                if(!is_array($item)){
                    array_push($ids, $item);
                }
            }
            $dados['carrinho'] = $carrinho->listar($ids);
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
                    $_SESSION['carrinho'] = array('qtds' => array());
                }
                if(in_array($id, $_SESSION['carrinho'])){
                    if($_SESSION['carrinho']['qtds'][$id] < $p->getQtd($id)){
                        $_SESSION["carrinho"]['qtds'][$id] += 1;
                    }
                    
                    
                }else{
                    array_push($_SESSION['carrinho'], $id);
                    $_SESSION['carrinho']['qtds'] = $this->array_push_assoc($_SESSION['carrinho']['qtds'], $id, 1);
                }

               header("Location: ".BASE_URL."carrinho");

               
            }
        }
    }
    public function remove($id){
        if(!empty($id)){
            $p = new Produto();
            if($p->prodExists($id)){
                if(in_array($id, $_SESSION['carrinho'])){
                    if($_SESSION['carrinho']['qtds'][$id] > 1){
                        $_SESSION["carrinho"]['qtds'][$id] -= 1;
                    }
                }

               header("Location: ".BASE_URL."carrinho");
               
            }
        }
    }

    public function array_push_assoc($array, $key, $value){
        $array[$key] = $value;
        return $array;
    }

    public function excluirItem($item = 0){
        $key = array_search($item, $_SESSION['carrinho']);
        
        if($key!==false){
            unset($_SESSION['carrinho'][$key]);
            unset($_SESSION['carrinho']['qtds'][$item]);
        }
        if(count($_SESSION['carrinho']) == 1){
            unset($_SESSION['carrinho']);
        }
        header("Location: ".BASE_URL."carrinho");
    }
}