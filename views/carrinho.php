<style>
    .menu, .form-inline, .navbar{
        display: none!important;
    }
    .breadcrumbsCarrinho{
        display: flex!important;
    }
</style>
<div class="bg-light py-2">
<section class="container row m-auto">
    <?php if(isset($carrinho)):?>
    <div class="col-md-7">
        <h4>Lista de produtos</h4>
        <table class="table cart shadow rounded">
        <thead class="bg-light text-center">
            <th width="70%" colspan=2 class="text-left py-0">Itens</th>
            <!-- <th></th> -->
            <th width="15%" class="py-0">Quantidade</th>
            <th width="25%" class="py-0">Preço</th>
            <!-- <th width="15%">Ações</th> -->
        </thead>
        <tbody class="text-center bg-white">
        <?php $subtotal = 0?>
        <?php foreach($carrinho as $prod):?>
        
            <tr class="itemsCart" data-id="<?php echo $prod['id']; ?>">
                <td colspan=2 class="text-left"><img width="60" src="<?php echo BASE_URL; ?>assets/images/<?php echo $cat->getCategoria($prod['id']); ?>/<?php echo $prod['imagem']; ?>" alt="<?php echo $prod['nome']; ?>"><span class="mx-1"><?php echo $prod['nome'];?></span></td>
                <!-- LISTAR A QUANTIDADE NO CARRINHO -->
                             
                <td class="col_qtd small"><button class="qtdMenos">-</button><span class="rounded qtd" data-estoque="<?php echo $prod['quantidade'];?>"><?php echo $_SESSION['carrinho']['qtds'][$prod['id']]; ?></span><button class="qtdMais">+</button><a href="<?php echo BASE_URL; ?>/carrinho/excluirItem/<?php echo $prod['id']; ?>" onclick="return confirm('Deseja excluir este item do carrinho?')">Remover</a></td></td>

                <td>R$ <span class="preco"><?php echo $prod['preco'] * $_SESSION['carrinho']['qtds'][$prod['id']];?></span></td>
                <!-- <td><a href="<?php echo BASE_URL; ?>/carrinho/excluirItem/<?php echo $prod['id']; ?>" onclick="return confirm('Deseja excluir este item do carrinho?')">Excluir</a></td> -->
            </tr>
            <?php $subtotal += $prod['preco'] * $_SESSION['carrinho']['qtds'][$prod['id']]?>
            <?php endforeach; ?>
                <tr class="bg-light">
                    <td colspan=3><span class="float-right">Subtotal: </span></td>
                    <td class="font-weight-bold h6">
                        R$ <span class="subtotal"><?php echo $subtotal?></span> 
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <a href="<?php echo BASE_URL; ?>" class="btn btn-warning text-white"> < Continuar comprando</a>
            <div class="d-flex align-items-center">
                <input type="text" class="inputDesconto form-control form-control-sm m-0" name="desconto">
                <button class="btn btn-sm text-light bg-secondary" onclick="descontos()">OK</button>
            </div>
        </div>
        <small class="float-right">Possui algum cupom de desconto?</small>
    </div>

    <aside class="resumo col-md-5">
    <h4>Resumo da compra</h4>
        <div class="frete row bg-white shadow border m-auto rounded">
            <div class="inputFrete row d-flex align-items-center justify-content-center container">
                <div class="truck col-1"></div>
                <div class=" col-5 d-flex flex-column">
                    <span>Frete e prazo:</span>
                    <a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" target="_blank" class="small">Não sei meu CEP</a>
                </div>
                <div class="form-group col-5 d-flex m-0">
                    <!-- <div class="row m-0"><small class="balaoCep col-9">Digite seu Cep</small></div> -->
                    <div class="row m-0">
                        <input type="text" class="cepProd form-control form-control-sm col-9 m-0" name="cep" placeholder="00000-000" value="<?php echo isset($_SESSION['frete']) ? $_SESSION['frete']['cep'] : '';?>" onkeypress="$(this).mask('00000-000')">
                        <button class="cepOk btn btn-sm text-light col-3 bg-secondary m-0 p-0">OK</button>
                    </div>
                </div>
            </div>
            
            <div class="col-12 bg-white fretePara d-flex flex-column">
                <div class="d-flex">
                    <div class="map_marker mr-1 mt-1"></div><div class="infoFrete"></div><button class="alterarCep btn btn-link btn-sm">Alterar</button>
                </div>
                <div class="infoPrazo container d-flex flex-column">
                    <div>
                        <input type="radio" name='freteRadio' class="form-check-input freteRadio" value="<?php echo $_SESSION['frete']['sedex']['tipo'];?>" <?php echo ($_SESSION['frete']['freteEscolhido'] == $_SESSION['frete']['sedex']['tipo']) ? 'checked' : ''; ?>><small><strong><?php echo $_SESSION['frete']['sedex']['tipo'];?> - </strong><span><?php echo $_SESSION['frete']['sedex']['prazo'];?> a </span> <span><?php echo (intval($_SESSION['frete']['sedex']['prazo']) + 2);?> dias úteis - </span><strong class="text-primary">R$ <?php echo $_SESSION['frete']['sedex']['valor']; ?></strong></small>
                    </div>
                    <div>
                        <input type="radio" name='freteRadio' class="form-check-input freteRadio" value="<?php echo $_SESSION['frete']['pac']['tipo'];?>" <?php echo ($_SESSION['frete']['freteEscolhido'] == $_SESSION['frete']['pac']['tipo']) ? 'checked' : ''; ?>><small><strong><?php echo $_SESSION['frete']['pac']['tipo'];?> - </strong><span><?php echo $_SESSION['frete']['pac']['prazo'];?> a </span> <span><?php echo (intval($_SESSION['frete']['pac']['prazo']) + 2);?> dias úteis - </span><strong class="text-primary">R$ <?php echo $_SESSION['frete']['pac']['valor']; ?></strong></small>
                    </div> 
                </div>
            </div>
        </div>
        <?php 
            $itens = array_sum($_SESSION['carrinho']['qtds']);
            $desconto = array_sum($_SESSION['carrinho']['descontos']);
        ?>
        <table class="table small border bg-white shadow">
            <thead class="text-center m-0 p-0 bg-light">
                <th class="p-0 m-0"></th>
                <th class="p-0 m-0"><small class="font-weight-bold">Boleto</small></th>
                <th class="p-0 m-0"><small class="font-weight-bold">Cartão</small></th>
            </thead>
            <tbody class="text-center m-0 p-0">
                <tr >
                    <td class="text-left m-0 p-1">
                        <?php echo "Itens: <strong class='text-primary'>".$itens."</strong>"; ?>
                    </td>
                    <td class="m-0 p-1 border">
                        <strong class="text-primary">R$ <?php echo number_format($subtotal - ($subtotal * 5/100),2,',','');?></strong>
                    </td>
                    <td class="m-0 p-1 border">
                        <strong class="text-primary">R$ <?php echo number_format($subtotal,2,',','');?></strong>
                    </td>
                </tr>
                <tr >
                    <td class="text-left m-0 p-1">
                        <span class="freteTipo">Frete <?php echo isset($_SESSION['frete']['freteEscolhido']) ? $_SESSION['frete']['freteEscolhido'] : ''; ?></span>
                    </td>
                    <td class="m-0 p-1 border" colspan="2">
                        <?php 
                        $valorFrete = 0;
                        if(isset($_SESSION['frete'])){
                            $valorFrete = ($_SESSION['frete']['freteEscolhido'] == $_SESSION['frete']['sedex']['tipo']) ? $_SESSION['frete']['sedex']['valor'] : $_SESSION['frete']['pac']['valor'];
                        }
                        ?>
                        <span class="freteTotal text-primary font-weight-bold text-right">R$ <?php echo number_format($valorFrete,2,',',''); ?></span>
                    </td>
                </tr>
                <tr >
                    <td class="text-left m-0 p-1">
                        <span>Desconto </span>
                    </td>
                    <td class="m-0 p-1 border">
                        <span class="desconto text-primary font-weight-bold text-right"><?php echo ($desconto+5)."%";?></span>
                    </td>
                    <td class="m-0 p-1 border">
                        <span class="desconto text-primary font-weight-bold text-right"><?php echo $desconto."%";?></span>
                    </td>
                </tr>
                <tr class="border-bottom">
                    <?php 
                        $boleto = $subtotal - ($subtotal * ($desconto+5)/100) + $valorFrete;
                        $cartao = $subtotal - ($subtotal * ($desconto/100)) + $valorFrete;
                    ?>
                    <td class="text-left px-1 m-0">
                        <div class="font-weight-bold">Total a Pagar </div>
                    </td>
                    <td class="m-0 border">
                        <div class="d-flex flex-column align-items-center">
                            <span class="desconto text-primary font-weight-bold text-right">R$ <?php echo number_format($boleto,2,',',''); ?></span>
                            <small>Boleto à vista</small>
                        </div>
                    </td>
                    <td class="m-0 border">
                        <div class="d-flex flex-column align-items-center">
                            <span class="desconto text-primary font-weight-bold text-right">R$ <?php echo number_format($cartao,2,',',''); ?></span>
                            <small>Em até 12x</small>
                        </div>
                    </td>
                </tr>
                <tr><td colspan="3" class="text-right m-0 p-0"><button class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalParcelas"><small>Todas as formas de pagamento</small></button></td></tr>
            </tbody>
        </table>
        
        <!-- <a href="<?php echo BASE_URL; ?>finalizar" class="btn btn-block btn-success finalizar my-3">Finalizar Compra</a> -->
        <form action="/processar-pagamento" method="POST">
            <script
                src="https://www.mercadopago.com.br/integrations/v1/web-tokenize-checkout.js"
                data-public-key="<?php echo ENV_PUBLIC_KEY;?>"
                data-transaction-amount="<?php echo $cartao; ?>">
            </script>
        </form>
    </aside>

    <!-- BANNER DO MP -->
    <div class="banner_meiosdepagamento d-flex justify-content-center w-100">
        <img src="https://imgmp.mlstatic.com/org-img/MLB/MP/BANNERS/tipo2_575X40.jpg?v=1" alt="Mercado Pago - Meios de pagamento" title="Mercado Pago - Meios de pagamento" width="575" height="40"/>
    </div>
    

    <!-- Modal Parcelas -->
    <div class="modal fade" id="modalParcelas" tabindex="-1" role="dialog" aria-labelledby="modalParcelas" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header py-0 d-flex align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel">Formas de Pagamento</h5>
                    <button type="button" class="close bg-secondary rounded p-1 m-2 text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <ul class="nav nav-tabs row p-0 w-100 m-auto">
                        <li class="nav-item col text-center p-0">
                            <a class="nav-link active tab small border p-1" href="#tableCartao"><img class="credit_card_img mx-2 rounded bg-info"/>Cartão de Crédito</a>
                        </li>
                        <li class="nav-item col text-center p-0">
                            <a class="nav-link tab small border p-1" href="#tableBoleto"><img class="boleto_img mx-2 rounded bg-warning"/>Boleto</a>
                        </li>
                    </ul>
                </div>

                <!-- CONTEÚDO TAB CARTÃO DE CRÉDITO -->
                <div class="tab-content">
                    <table id="tableCartao" class="table">
                        <th>Parcelas</th>
                        <th>Valor</th>
                        <?php for($i = 0; $i < count($_SESSION['carrinho']['taxas']); $i++):?>
                        <?php 
                            $taxa =  floatval($_SESSION['carrinho']['taxas'][$i]);
                            $valor_parcela = round(($cartao + ($cartao * ($taxa / 100))) / ($i+1),2);   
                            $valor_juros = $valor_parcela * ($i+1);   
                        ?>
                            <tr>
                                <td class="p-1"><?php echo ($i+1)."x de R$ ".number_format($valor_parcela,2,',','');?></td>
                                <td class="p-1"><?php echo ($i == 0) ? "(sem juros)" : number_format($valor_juros,2,',','');?></td>
                            </tr>
                        <?php endfor;?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div style="clear:both";></div>
    <?php else:?>
    <div class="w-100 text-center h3 my-4 bg-light">Não há itens no carrinho!</div>
    <?php endif;?> 
  
</section>
</div>
