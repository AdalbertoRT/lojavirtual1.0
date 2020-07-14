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
    <?php echo (isset($erro)) ? "<div class='alert alert-warning'>$erro</div>" : "";?>
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

        <?php foreach($carrinho as $prod):?>
            <tr class="itemsCart" data-id="<?php echo $prod['id']; ?>">
                <td colspan=2 class="text-left"><img width="60" src="<?php echo BASE_URL; ?>assets/images/<?php echo $cat->getCategoria($prod['id']); ?>/<?php echo $prod['imagem']; ?>" alt="<?php echo $prod['nome']; ?>"><span class="mx-1"><?php echo $prod['nome'];?></span></td>
                
                <!-- LISTAR A QUANTIDADE NO CARRINHO -->            
                <td class="col_qtd small"><button class="qtdMenos">-</button><span class="rounded qtd" data-estoque="<?php echo $prod['quantidade'];?>"><?php echo $_SESSION['carrinho']['qtds'][$prod['id']]; ?></span><button class="qtdMais">+</button><a href="<?php echo BASE_URL; ?>/carrinho/excluirItem/<?php echo $prod['id']; ?>" onclick="return confirm('Deseja excluir este item do carrinho?')">Remover</a></td></td>

                <td>R$ <span class="preco"><?php echo $prod['preco'] * $_SESSION['carrinho']['qtds'][$prod['id']];?></span></td>
                
            </tr>
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
             <!--DESCONTOS  -->
            <form action="<?php echo BASE_URL;?>carrinho/descontos" method="POST" class="d-flex align-items-center">
                <input type="text" class="inputDesconto form-control form-control-sm m-0" name="desconto">
                <input type='submit' class="btn btn-sm text-light bg-secondary" value="OK">
            </form>
        </div>
        <small class="float-right">Possui algum cupom de desconto?</small>
    </div>

    <!-- RESUMO DA COMPRA -->
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
                        <input type="text" class="cepProd form-control form-control-sm col-9 m-0" name="cep" placeholder="00000-000" value="<?php echo $cep;?>" onkeypress="$(this).mask('00000-000')">
                        <button class="cepOk btn btn-sm text-light col-3 bg-secondary m-0 p-0">OK</button>
                    </div>
                </div>
            </div>
            
            <div class="col-12 bg-white fretePara d-flex flex-column">
                <div class="d-flex">
                    <div class="map_marker mr-1 mt-1"></div><div class="infoFrete"></div><button class="alterarCep btn btn-link btn-sm">Alterar</button>
                </div>
                <?php if(isset($_SESSION['frete'])):?>
                <div class="infoPrazo container d-flex flex-column">
                    <div>
                        <input type="radio" name='freteRadio' class="form-check-input freteRadio" value="<?php echo $_SESSION['frete']['sedex']['tipo'];?>" <?php echo ($freteEscolhido == $_SESSION['frete']['sedex']['tipo']) ? 'checked' : ''; ?>><small><strong><?php echo $_SESSION['frete']['sedex']['tipo'];?> - </strong><span><?php echo $prazoSedex;?> a </span> <span><?php echo (intval($prazoSedex) + 2);?> dias úteis - </span><strong class="text-primary">R$ <?php echo $valorSedex; ?></strong></small>
                    </div>
                    <div>
                        <input type="radio" name='freteRadio' class="form-check-input freteRadio" value="<?php echo $_SESSION['frete']['pac']['tipo'];?>" <?php echo ($freteEscolhido == $_SESSION['frete']['pac']['tipo']) ? 'checked' : ''; ?>><small><strong><?php echo $_SESSION['frete']['pac']['tipo'];?> - </strong><span><?php echo $prazoPac;?> a </span> <span><?php echo (intval($prazoPac) + 2);?> dias úteis - </span><strong class="text-primary">R$ <?php echo $valorPac; ?></strong></small>
                    </div> 
                </div>
                <?php endif;?>
            </div>
        </div>
    
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
                <!-- ROW FRETE -->
                <tr >
                    <td class="text-left m-0 p-1">
                        <span class="freteTipo">Frete: <strong><?php echo isset($freteEscolhido) ? strtoupper($freteEscolhido) : ''; ?><strong></span>
                    </td>
                    <td class="m-0 p-1 border" colspan="2">
                        <span class="freteTotal text-primary font-weight-bold text-right">R$ <?php echo $valorFrete; ?></span>
                    </td>
                </tr>
                <!-- ROW DESCONTO -->
                <tr >
                    <td class="text-left m-0 p-1">
                        <span>Desconto </span>
                    </td>
                    <td class="m-0 p-1 border">
                        <span class="desconto text-primary font-weight-bold text-right"><?php echo ($descontos+5)."%";?></span>
                    </td>
                    <td class="m-0 p-1 border">
                        <span class="desconto text-primary font-weight-bold text-right"><?php echo $descontos."%";?></span>
                    </td>
                </tr>
                <tr class="border-bottom">
                    <td class="text-left px-1 m-0">
                        <div class="font-weight-bold">Total a Pagar </div>
                    </td>
                    <td class="m-0 border">
                        <div class="d-flex flex-column align-items-center">
                            <span class="desconto text-primary font-weight-bold text-right">R$ <?php echo number_format($valorBoleto,2,',',''); ?></span>
                            <small>Boleto à vista</small>
                        </div>
                    </td>
                    <td class="m-0 border">
                        <div class="d-flex flex-column align-items-center">
                            <span class="desconto text-primary font-weight-bold text-right">R$ <span id="valor_cartao"><?php echo number_format($valorCartao,2,',',''); ?></span></span>
                            <small>Em até 12x</small>
                        </div>
                    </td>
                </tr>
                <?php if(isset($_SESSION['frete'])):?>
                <tr><td colspan="3" class="text-right m-0 p-0"><button class="btn btn-link btn-sm verParcelas" data-toggle="modal" data-target="#modalParcelas"><small>Todas as formas de pagamento</small></button></td></tr>
                <?php else:?>
                <tr><td colspan="3" class="text-right m-0 p-0"><button class="btn btn-disabled btn-sm verParcelas" data-toggle="modal" data-target="#modalParcelas" disabled><small>Todas as formas de pagamento</small></button></td></tr>
                <?php endif;?>
            </tbody>
        </table>
       <?php if(isset($_SESSION['frete'])):?>
       <!-- <form action="<?php echo BASE_URL;?>finalizar">
            <input type="hidden" name="boleto" value="<?php echo $boleto;?>">
            <input type="hidden" name="cartao" value="<?php echo $cartao;?>">
            <input type="submit" class="btn btn-block btn-success finalizar my-3">Finalizar Compra</button>
       </form> -->
       <a href="<?php echo BASE_URL;?>finalizar" class="btn btn-block btn-success finalizar my-3">Finalizar Compra</a>

       <?php else: ?>
        <button class="btn btn-block btn-success btn-disabled  my-3" disabled>Finalizar Compra</button>
       <?php endif;?>
        <!-- <form action="<?php echo BASE_URL;?>pospay" method="POST">
            <script
                src="https://www.mercadopago.com.br/integrations/v1/web-tokenize-checkout.js"
                data-public-key="<?php echo ENV_PUBLIC_KEY;?>"
                data-transaction-amount="<?php echo $cartao; ?>">
            </script>
        </form> -->
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
                    <nav class="d-flex justify-content-center">
                        <div class="nav nav-tabs border rounded row w-100" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active col text-center" id="nav-card-tab" data-toggle="tab" href="#nav-card" role="tab" aria-controls="nav-card" aria-selected="true"><img src="<?php BASE_URL;?>assets/images/icons/credit_card.png" class="credit_card_img mx-2 rounded bg-white"/>Cartão de Crédito</a>
                            <a class="nav-item nav-link col text-center" id="nav-boleto-tab" data-toggle="tab" href="#nav-boleto" role="tab" aria-controls="nav-boleto" aria-selected="false"><img src="<?php BASE_URL;?>assets/images/icons/boleto.png" class="boleto_img mx-2 rounded bg-white"/>Boleto</a>
                        </div>
                    </nav>
                    <div class="tab-content">
                    <!-- CONTEÚDO TAB CARTÃO DE CRÉDITO -->
                        <div id="nav-card" class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-card-tab">
                            <table class="table text-center">
                                <thead>
                                    <th class="p-1">Parcelas</th>
                                    <th class="p-1">Valor</th>
                                </thead>
                                <tbody class="info-parcelas p-1">
                                    
                                </tbody>
                            </table>
                        </div>
                        <!-- CONTEÚDO TAB BOLETO -->
                        <div id="nav-boleto" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-boleto-tab">
                            <div class="p-2 text-justify">
                                <p class="m-0 my-2">Boleto Bancário com <span class="text-primary">5%</span> de desconto: <span class="text-primary">R$ <?php echo number_format($boleto,2,',',''); ?></span></p>
                                <p class="m-0">Efetue o pagamento pela internet, em bancos, lotéricas ou correios.</p>
                                <p class="m-0">Quanto antes você pagar, mais rápido será a sua entrega.</p>
                                <p class="m-0">O boleto tem vencimento de 3 dias a partir da confirmação da compra.</p>
                                <p>Lembre-se que a compensação do boleto pode demorar até 3 dias úteis.</p>
                            </div>
                        </div>
                    </div>
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
