<?php
class finalizarController extends controller{
    public  function index($error = ""){
        $dados = array();
        if(!empty($error)){
            $dados["erro"] = "Digite todos os campos obrigatórios!";
        }
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
            $_SESSION['notLogged'] = array();
            header("Location: ".BASE_URL."login");
        }
        
        $this->loadTemplate("finalizar", $dados);
    }

    public function pagar(){
        if(isset($_POST['cep']) && !empty($_POST['cep']) && isset($_POST['pagamentos']) && !empty($_POST['pagamentos'])){
            $id_usuario = $_SESSION['logado']['id'];
            $endereco = "CEP: ".addslashes($_POST['cep'])." ".addslashes($_POST['logradouro'])." ".addslashes($_POST['numero'])." ".addslashes($_POST['bairro'])." ".addslashes($_POST['cidade'])." ".addslashes($_POST['uf'])." ".addslashes($_POST['complemento']) ;
            $prods = array();
            $preco = new Produto();
            $valor = 0;
            foreach($_SESSION['carrinho'] as $item){
                if(!is_array($item)){
                    array_push($prods, $item);
                    $valor += floatval($preco->getPreco($item) * $_SESSION['carrinho']['qtds'][$item]);
                }else{
                    $qtds = $item;
                }
            }
            $forma_pg = intval(addslashes($_POST['pagamentos']));

            $venda = new Venda();
            $venda->setVenda($id_usuario, $endereco, $valor, $forma_pg, $prods, $qtds);
           
            header("Location: ".BASE_URL."obrigado");
        }else{
            // $erro = "Digite todos os campos obrigatórios!";
            header("Location: ".BASE_URL."finalizar/index/error");
        }
    }
    
}