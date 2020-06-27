<?php
class Correios {

    public $retornoSedex;
    public $retornoPac;
    private $sedex;
    private $pac;
    private $barato;

    public function fretePrazo($cepOrigem, $cepDestino, $peso, $formato, $comprimento, $altura, $largura, $maoPropria, $valorDeclarado, $avisoRecebimento, $sedex, $pac, $diametro){
        $fsedex = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem={$cepOrigem}&sCepDestino={$cepDestino}&nVlPeso={$peso}&nCdFormato={$formato}&nVlComprimento={$comprimento}&nVlAltura={$altura}&nVlLargura={$largura}&sCdMaoPropria={$maoPropria}&nVlValorDeclarado={$valorDeclarado}&sCdAvisoRecebimento={$avisoRecebimento}&nCdServico={$sedex}&nVlDiametro={$diametro}&StrRetorno=xml&nIndicaCalculo=3";
        
        $fpac = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem={$cepOrigem}&sCepDestino={$cepDestino}&nVlPeso={$peso}&nCdFormato={$formato}&nVlComprimento={$comprimento}&nVlAltura={$altura}&nVlLargura={$largura}&sCdMaoPropria={$maoPropria}&nVlValorDeclarado={$valorDeclarado}&sCdAvisoRecebimento={$avisoRecebimento}&nCdServico={$pac}&nVlDiametro={$diametro}&StrRetorno=xml&nIndicaCalculo=3";
        

        $this->retornoSedex = simplexml_load_string(file_get_contents($fsedex));
        $this->retornoPac = simplexml_load_string(file_get_contents($fpac));
        // return $this->retorno;

        $sedexValor = str_replace(',','.',(string)$this->retornoSedex->cServico->Valor);
        $pacValor = str_replace(',','.',(string)$this->retornoPac->cServico->Valor);
        $this->sedex = array(
            'tipo' => 'Sedex',
            'valor' => $sedexValor,
            'prazo' => (string)$this->retornoSedex->cServico->PrazoEntrega
        );

        $this->pac = array(
            'tipo' => 'PAC',
            'valor' => $pacValor,
            'prazo' => (string)$this->retornoPac->cServico->PrazoEntrega
        );
        
        if(!isset($_SESSION['frete'])){
            if(floatval($sedexValor) <= floatval($pacValor)) {
                $barato = $this->sedex['tipo'];
            }else{
                $barato = $this->pac['tipo'];;
            }
        }else{
            $barato = $_SESSION['frete']['freteEscolhido'];
        }      
        
        // $this->pac = "<p class='p-0 m-0'><input type='radio' name='frete' id='pac' value=".$this->retornoPac->cServico->Valor." class='form-check-input freteRadio' onclick='valorFrete(`PAC`, this.value)' checked/><strong>PAC</strong>: ".$this->retornoPac->cServico->PrazoEntrega." a ".($this->retornoPac->cServico->PrazoEntrega + 2)." dias úteis - <span class='text-primary font-weight-bold freteValor'>R$ ".$this->retornoPac->cServico->Valor."</span></p>";

        // if(isset($_SESSION['frete'])){
        //     unset($_SESSION['frete']);
        // }

        $_SESSION['frete'] = array(
            'cep' => $cepDestino,
            'sedex' => $this->sedex,
            'pac' => $this->pac,
            'freteEscolhido' => $barato
        );

    }

    // http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=700029 00&sCepDestino=71939360&nVlPeso=1&nCdFormato=1&nVlComprimento=30&nVlAltura=30&nVlLargura=3 0&sCdMaoPropria=n&nVlValorDeclarado=0&sCdAvisoRecebimento=n&nCdServico=40010&nVlDiametro=0& StrRetorno=xml&nIndicaCalculo=3 

}