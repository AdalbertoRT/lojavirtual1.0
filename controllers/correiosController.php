<?php
class correiosController extends controller {

    public function fretePrazoCarrinho($cepDestino, $sedex, $pac) {
        $cepOrigem = CEP_ORIGEM;
        $formato = 1;
        $maoPropria = "N";
        $valorDeclarado = 0;
        $avisoRecebimento = "N";
        
        $produto = new Produto();
        $total_peso = 0;
        $total_cm_cubico = 0;
        foreach($_SESSION['carrinho'] as $prod){
            if(!is_array($prod)){
                $item = $produto->getProduto($prod);
                $item_peso = $item['peso'] * $_SESSION['carrinho']['qtds'][$prod];
                $item_cm = (ceil($item['altura']) * ceil($item['largura']) * ceil($item['comprimento'])) * $_SESSION['carrinho']['qtds'][$prod];

                $total_peso += $item_peso;
                $total_cm_cubico += $item_cm;  
            }
        }
        $raiz_cubica = round(pow($total_cm_cubico, 1/3));

        $comprimento =  $raiz_cubica < 16 ? 16 : $raiz_cubica;
        $altura = $raiz_cubica < 2 ? 2 : $raiz_cubica;
        $largura = $raiz_cubica < 11 ? 11 : $raiz_cubica;
        $peso = $total_peso < 0.3 ? 0.3 : $total_peso;
        $diametro = hypot($comprimento, $largura); // Calculando a hipotenusa pois minhas encomendas são retangulares

        $correios = new Correios();
        $freteprazo = $correios->fretePrazo($cepOrigem, $cepDestino, $peso, $formato, $comprimento, $altura, $largura, $maoPropria, $valorDeclarado, $avisoRecebimento, $sedex, $pac, $diametro);
        return $freteprazo;
    }

    public function fretePrazoProduto($id, $cepDestino, $sedex, $pac) {
        $cepOrigem = CEP_ORIGEM;
        $formato = 1;
        $maoPropria = "N";
        $valorDeclarado = 0;
        $avisoRecebimento = "N";
        
        $produto = new Produto();
        $item = $produto->getProduto($id);
        $item_peso = $item['peso'];
        $item_cm_cubico = (ceil($item['altura']) * ceil($item['largura']) * ceil($item['comprimento']));
  
        $raiz_cubica = round(pow($item_cm_cubico, 1/3));

        // $comprimento =  $raiz_cubica < 16 ? 16 : $raiz_cubica;
        // $altura = $raiz_cubica < 2 ? 2 : $raiz_cubica;
        // $largura = $raiz_cubica < 11 ? 11 : $raiz_cubica;
        // $peso = $item_peso < 0.3 ? 0.3 : $item_peso;
        // $diametro = hypot($comprimento, $largura); // Calculando a hipotenusa pois minhas encomendas são retangulares
        $comprimento =  $item["comprimento"] < 16 ? 16 : $item["comprimento"];
        $altura = $item["altura"] < 2 ? 2 : $item["altura"];
        $largura = $item["largura"] < 11 ? 11 : $item["largura"];
        $peso = $item_peso < 0.3 ? 0.3 : $item_peso;
        $diametro = hypot($comprimento, $largura); // Calculando a hipotenusa pois minhas encomendas são retangulares

        $correios = new Correios();
        $freteprazo = $correios->fretePrazo($cepOrigem, $cepDestino, $peso, $formato, $comprimento, $altura, $largura, $maoPropria, $valorDeclarado, $avisoRecebimento, $sedex, $pac, $diametro);
        return $freteprazo;
    }

    public function freteEscolhido($sel){
        if(isset($_SESSION['frete'])){
            $_SESSION['frete']['freteEscolhido'] = $sel;
            var_dump($_SESSION['frete']);exit;
        }
    }
}