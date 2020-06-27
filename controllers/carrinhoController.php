<?php
class carrinhoController extends controller{

    public function index(){
        // session_destroy();
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
                    // CRIAÇÃO DA $_SESSION['carrinho']
                    $_SESSION['carrinho'] = array('qtds' => array(), 'descontos' => array(), 'taxas' => array());
                    
                    // POPULAR ARRAY TAXAS DO $_SESSION['carrinho']
                    $parcelas = new Carrinho();
                    $parcelas = $parcelas->getParcelas();
                    $taxas = array();
                    foreach($parcelas as $p){
                        array_push($taxas, $p['taxa']);
                    }
                    $_SESSION['carrinho']['taxas'] = $taxas;
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

    // FUNÇÃO QUE ADICIONA CHAVE E VALOR EM UM ARRAY DENTRO DE OUTRO ARRAY - Ex: [key_personalizado] => [valor]
    public function array_push_assoc($array, $key, $value){
        $array[$key] = $value;
        return $array;
    }

    public function excluirItem($item = 0){
        $key = array_search($item, $_SESSION['carrinho']);
        $contador = 0;
        if($key!==false){
            unset($_SESSION['carrinho'][$key]);
            unset($_SESSION['carrinho']['qtds'][$item]);
        }
        foreach($_SESSION['carrinho'] as $elemento){
            if(!is_array($elemento)){
                $contador++;
            }
        }
        if($contador == 0){
            unset($_SESSION['carrinho']);
        }
        // if(count($_SESSION['carrinho']) == 2){
        //     unset($_SESSION['carrinho']);
        // }
        header("Location: ".BASE_URL."carrinho");
    }

    public function descontos($codigo){
        $valor = 0;
        if(isset($_SESSION['carrinho'])){
            $desconto = new Desconto();
            $valor = $desconto->getDesconto($codigo);
            $_SESSION['carrinho']['descontos'] = $this->array_push_assoc($_SESSION['carrinho']['descontos'], $codigo, $valor);
            echo $valor;
        }
    }

    // public function parcelamentos(){
    //     if(isset($_SESSION['carrinho'])){
    //         $parcelas = new Carrinho();
    //         $parcelas = $parcelas->getParcelas();
    //         $taxas = array();
    //         foreach($parcelas as $p){
    //            array_push($taxas, $p['taxa']);
    //         }
    //         $_SESSION['carrinho']['taxas'] = $taxas;
            
    //     }
    // }
}