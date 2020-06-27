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

    public function pagamento(){
        if(isset($_SESSION['carrinho'])){
            $id_usuario = $_SESSION['logado']['id'];
            $endereco = "CEP: ".addslashes($_POST['cep'])." ".addslashes($_POST['logradouro'])." ".addslashes($_POST['numero'])." ".addslashes($_POST['bairro'])." ".addslashes($_POST['cidade'])." ".addslashes($_POST['uf'])." ".addslashes($_POST['complemento']) ;
            $prods = array();
            $preco = new Produto();
            $valor = 0;
            date_default_timezone_set('America/Sao_Paulo');
            $data_venda = date(DATE_RFC850);
            foreach($_SESSION['carrinho'] as $item){
                if(!is_array($item)){
                    array_push($prods, $item);
                    $valor += floatval($preco->getPreco($item) * $_SESSION['carrinho']['qtds'][$item]);
                }else{
                    $qtds = $item;
                }
            }

            // WEB TOKENIZER
            require_once './libs/vendor/autoload.php';

            $token = $_REQUEST["token"];
            $payment_method_id = $_REQUEST["payment_method_id"];
            $installments = $_REQUEST["installments"];
            $issuer_id = $_REQUEST["issuer_id"];

            MercadoPago\SDK::setAccessToken("ENV_ACCESS_TOKEN");

            $payment = new MercadoPago\Payment();

            $payment->transaction_amount = 141;
            $payment->token = "YOUR_CARD_TOKEN";
            $payment->description = "Ergonomic Silk Shirt";
            $payment->installments = 1;
            $payment->payment_method_id = "visa";
            $payment->payer = array(
            "email" => $_SESSION['logado']['email']
            );

            $payment->save();

            echo $payment->status;

            // SMART CHECKOUT
            // SDK de Mercado Pago
            // require './libs/vendor/autoload.php';

            // // Configura credenciais
            // MercadoPago\SDK::setAccessToken('ENV_ACCESS_TOKEN');

            // // Cria um objeto de preferência
            // $preference = new MercadoPago\Preference();

            // // Cria um item na preferência
            // $item = new MercadoPago\Item();
            // $item->title = 'Meu produto';
            // $item->quantity = 1;
            // $item->unit_price = 75.56;
            // $preference->items = array($item);
            // $preference->save();
            // $dados = array('pagamento' => $preference->id);
            // $this->loadViewTemplate("finalizar", $dados);
        }else{
            header("Location: ".BASE_URL."finalizar/index/error");
        }
    }

    public function pagar(){
        if(isset($_POST['cep']) && !empty($_POST['cep']) && isset($_POST['pagamentos']) && !empty($_POST['pagamentos'])){
            $id_usuario = $_SESSION['logado']['id'];
            $endereco = "CEP: ".addslashes($_POST['cep'])." ".addslashes($_POST['logradouro'])." ".addslashes($_POST['numero'])." ".addslashes($_POST['bairro'])." ".addslashes($_POST['cidade'])." ".addslashes($_POST['uf'])." ".addslashes($_POST['complemento']) ;
            $prods = array();
            $preco = new Produto();
            $valor = 0;
            date_default_timezone_set('America/Sao_Paulo');
            $data_venda = date(DATE_RFC850);
            foreach($_SESSION['carrinho'] as $item){
                if(!is_array($item)){
                    array_push($prods, $item);
                    $valor += floatval($preco->getPreco($item) * $_SESSION['carrinho']['qtds'][$item]);
                }else{
                    $qtds = $item;
                }
            }

            // forma_pg => 1 = Cartão;
            // forma_pg => 2 = Boleto;
            // forma_pg => 3 = Depósito;
            $forma_pg = intval(addslashes($_POST['pagamentos']));
            if($forma_pg == 1){
                $dados = array("modal");
                $this->loadTemplate("finalizar", $dados);
            }

            $venda = new Venda();
            $venda->setVenda($id_usuario, $endereco, $valor, $forma_pg, $prods, $qtds, $data_venda);
           
            header("Location: ".BASE_URL."obrigado");
        }else{
            // $erro = "Digite todos os campos obrigatórios!";
            header("Location: ".BASE_URL."finalizar/index/error");
        }
    }
    
}
