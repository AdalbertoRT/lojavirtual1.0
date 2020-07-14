<section class="container">
<div id="finalizar">

    <?php if(isset($erro)): ?>
        <div class="alert alert-danger mt-2 mb-0"><?php echo $erro; ?></div>
    <?php endif; ?>
    <?php if(isset($modal)): ?>
        <div class="alert alert-danger mt-2 mb-0"><?php echo $erro; ?></div>
    <?php endif; ?>

    <h3>Finalizar Compra</h3>
    <section class="rounded shadow p-3 text-light container d-flex flex-column justify-content-center pagamento">
    <h5 class="text-center">Selecione a forma de pagamento</h5>
    <nav class="w-100 m-auto pb-3">
        <div class="nav nav-pills border-bottom-0 row w-md-75 m-auto" id="nav-pills" role="tablist">
            <a class="nav-item nav-link nav-card active border tab col text-center m-1 pgType d-flex  align-items-center" id="nav-card-tab" data-toggle="tab" href="#nav-card" role="tab" aria-controls="nav-card" aria-selected="true"><i class="radio selected"></i><img src="<?php BASE_URL;?>assets/images/icons/credit_card.png" class="credit_card_img mx-2 rounded bg-white"/><span class="tipoPg">Cartão de Crédito</span></a><span></span>
            <a class="nav-item nav-link nav-bol border tab col text-center m-1 pgType d-flex align-items-center" id="nav-boleto-tab" data-toggle="tab" href="#nav-boleto" role="tab" aria-controls="nav-boleto" aria-selected="false"><i class="radio"></i><img src="<?php BASE_URL;?>assets/images/icons/boleto.png" class="boleto_img mx-2 rounded bg-white"/><span class="tipoPg">Boleto</span></a>
        </div>
    </nav>
    <div class="tab-content">
    <!-- CONTEÚDO TAB CARTÃO DE CRÉDITO -->
        <div id="nav-card" class="tab-pane fade show active tab-card" role="tabpanel" aria-labelledby="nav-card-tab">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="card_number">Número do cartão</label>
                        <div class="d-flex">
                            <input type="text" class="form-control" id="cardNumber" data-checkout="cardNumber" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                            <div class="input-group-prepend p-1 border rounded shadow bg-white align-self-center position-absolute" id="brand_card" style="display: none; right:10px;"></div>
                        </div>
                    </div> 
                                              
                    <div class="form-group col-md-6 d-flex">
                        <div class="flex-column col-8 p-0">
                            <label for="expiration_date">Data de validade</label>
                            <div class="d-flex">
                            <select class="form-control mx-1 p-0" id="cardExpirationMonth" data-checkout="cardExpirationMonth" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                            <?php 
                                for($i=1; $i<=12; $i++){
                                echo ($i < 10) ? "<option>0$i</option>" : "<option>$i</option>";
                                }
                            ?>
                            </select>

                            <select class="form-control mx-1 p-0" id="cardExpirationYear" value="2025" data-checkout="cardExpirationYear" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
                            <?php 
                                for($i=date("Y"); $i<=date("Y", strtotime("+25 years")); $i++){
                                    echo "<option>$i</option>";
                                }
                            ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group col-4 p-0 m-0 mx-1 mt-1">
                            <label for="security_code" title="Código de Segurança" class="m-0 mb-1 d-flex justify-content-between">CVV <a class="text-light p-0 font-weight-bold" data-toggle="modal" data-target="#exampleModal">?</a></label>
                            <input type="text" class="form-control p-0" id="securityCode" data-checkout="securityCode" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off class="form-control" title="Código de Segurança do Cartão">
                        </div>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content text-dark">
                            <div class="modal-header bg-secondary text-light">
                                <h5 class="modal-title" id="exampleModalLabel">Código de Segurança</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            O Código de Verificação de Cartão, ou CVC*, é o código adicional impresso no verso do cartão de crédito. Na maioria dos cartões (Visa, MasterCard, cartões de bancos, etc.) é os últimos três dígitos impressos na faixa para assinatura localizada no verso do cartão. Nos cartões American Express (AMEX), geralmente é um código de quatro dígitos na frente do cartão.
                            <img width="100%" src="<?php echo BASE_URL; ?>assets/images/cvc.jpg" alt="Códigos CVC" class="mt-3">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div> 
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cardholderName">Nome Completo</label>
                        <input type="text" id="cardholderName" data-checkout="cardholderName" class="form-control"/>
                    </div>
                    <div class="col-md-6 row">
                        <div class="form-group col-4">
                            <label for="docType">Documento</label>
                            <select id="docType" data-checkout="docType" class="form-control"></select>
                        </div>
                        <div class="form-group col-8">
                            <label for="docNumber">Número do documento</label>
                            <input type="text" id="docNumber" data-checkout="docNumber" class="form-control"/>
                        </div>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label for="installments">Parcelas</label>
                    <select id="installments" class="form-control" name="installments" class="form-control"></select>
                </div>
                <?php 
                    $freteEscolhido = strtolower($_SESSION['frete']['freteEscolhido']);
                    $valorFrete = number_format($_SESSION['frete'][$freteEscolhido]['valor'], 2);
                ?>           
                <input type="text" name="transaction_amount" id="transaction_amount" value="<?php echo $valorFrete;?>"/>
                
                <input type="hidden" name="payment_method_id" id="payment_method_id"/>
                <input type="submit" value="Pagar" class="btn btn-success"/>
            </form>
        </div>
        <!-- CONTEÚDO TAB BOLETO -->
        <div id="nav-boleto" class="tab-pane fade tab-bol" role="tabpanel" aria-labelledby="nav-boleto-tab">
            <div class="p-2 text-justify">
                <p class="m-0 my-2">Boleto Bancário com <span class="text-primary">5%</span> de desconto: <span class="text-primary">R$ <?php echo number_format($boleto,2,',',''); ?></span></p>
                <p class="m-0">Efetue o pagamento pela internet, em bancos, lotéricas ou correios.</p>
                <p class="m-0">Quanto antes você pagar, mais rápido será a sua entrega.</p>
                <p class="m-0">O boleto tem vencimento de 3 dias a partir da confirmação da compra.</p>
                <p>Lembre-se que a compensação do boleto pode demorar até 3 dias úteis.</p>
            </div>
        </div>
    </div>
    <form method="POST" id="pagar" action="<?php echo BASE_URL; ?>finalizar/pagamento">
        <!-- DADOS DOS PRODUTOS -->
        <fieldset class="border border-secondary rounded px-4 py-2">
        <legend class="p-0 ml-4">Finalizar Compra</legend>
        <?php if(isset($carrinho)): ?>
        <h5 class="bg-dark pl-1 text-light">Produtos</h5>
        <table class="table table_finalizar m-0">
            <thead class="text-center small">
                <th class="p-0 col_foto" width="15%">Foto</th>
                <th class="p-0 col_nome">Nome</th>
                <th class="p-0 col_qtd" width="15%">Qtd</th>
                <th class="p-0" width="15%">Valor</th>
            </thead>
            <tbody>
            <?php $subtotal = 0; $quantidade = 0; ?>
            <?php foreach($carrinho as $prod):?>
                
                <tr class="text-center">
                    <td class="col_foto"><img width="30" src="<?php echo BASE_URL; ?>assets/images/<?php echo $cat->getCategoria($prod['id']); ?>/<?php echo $prod['imagem']; ?>" alt="<?php echo $prod['nome']; ?>"></td>
                    <td class="col_nome small"><?php echo $prod['nome'];?></td>
                    <td style="width:100px" class="col_qtd small"><span class="rounded qtd"><?php echo $_SESSION['carrinho']['qtds'][$prod['id']];?></span></td>
                    <td class="small">R$ <strong class="preco" data-key="<?php echo $prod['id'];?>"><?php echo $prod['preco'] * $_SESSION['carrinho']['qtds'][$prod['id']];?></strong></td>
                </tr>  
                <?php $subtotal += $prod['preco'] * $_SESSION['carrinho']['qtds'][$prod['id']];
                      $quantidade += $_SESSION['carrinho']['qtds'][$prod['id']];
                ?>              
            <?php endforeach; ?>
            <tr class="bg-secondary text-light border"><td></td><td></td><td class="text-center">Items: <strong><?php echo $quantidade; ?></strong></td><td>Subtotal: R$ <strong><?php echo $subtotal; ?></strong></td></tr>
            </tbody>
        </table>
        <?php endif;?>
       
        <!-- DADOS DO COMPRADOR -->
        <h5 class="bg-dark text-light pl-1 mt-3">Comprador</h5>
            <div class="container row p-0">
                <div class="col-md-6">
                    <div class="small m-1">Nome: <strong><?php  echo $_SESSION['logado']['nome'];?></strong></div>
                    <div class="small m-1">Email: <strong><?php  echo $_SESSION['logado']['email'];?></strong></div>
                    <div class="small m-1">Telefone: <strong><?php  echo $_SESSION['logado']['telefone'];?></strong></div>
                </div>
                <div class="col-md-6">
                    <div class="small m-1 mb-2">
                        CPF:  <input type="text" class="form-control form-control-sm" id="cpfComprador" name="cpf" placeholder="000.000.000-00">
                        <span class="text-primary mb-4">Digite seu CPF para emissão da nota fiscal.</span>
                    </div>
                </div>
            </div>
      
        <!-- ENDEREÇO DO COMPRADOR -->
        <h5 class="bg-dark pl-1 text-light">Endereço de Entrega</h5>
            <div class="row">
                <div class="form-group col-md-4 pr-md-1 m-0">
                    <div class="row m-0"><label for="cep" class="small">Cep: </label> <small class="balaoCep">Digite seu Cep</small></div>
                    <input type="text" class="form-control form-control-sm" id="cep" name="cep" placeholder="00000-000" value="<?php echo $_SESSION['logado']['cep'];?>">
                </div>
                <div class="form-group col-md-6 px-md-1 m-0">
                    <label for="rua" class="small">Logradouro: </label>
                    <input type="text" class="form-control form-control-sm" id="logradouro" name="logradouro" placeholder="Rua, Av., Estrada etc" title="Rua, Av., Estrada etc">
                </div>
                <div class="form-group col-md-2 pl-md-1 m-0">
                <div class="row m-0"><label for="numero" class="small">Nº: </label><small class="balaoNumero">Digite o Numero</small></div>
                    <input type="text" class="form-control form-control-sm" id="numero" name="numero" placeholder="Nº da residência" title="Nº da Residência">
                </div>
                <div class="form-group col-md-4 m-0 pr-md-1">
                    <label for="cidade" class="small">Bairro: </label>
                    <input type="text" class="form-control form-control-sm" id="bairro" name="bairro" placeholder="Bairro">
                </div>
                <div class="form-group col-md-6 m-0 px-md-1">
                    <label for="cidade" class="small">Cidade: </label>
                    <input type="text" class="form-control form-control-sm" id="cidade" name="cidade" placeholder="Cidade">
                </div>
                <div class="form-group col-md-2 m-0 pl-md-1">
                    <label for="uf" class="small">Estado: </label>
                    <select class="form-control form-control-sm" id="uf" name="uf">
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
		</select>
                </div>
                
                <div class="form-group col-12 m-0">
                    <label for="complemento" class="small">Complemento: </label>
                    <input type="text" class="form-control form-control-sm" id="complemento" name="complemento" placeholder="Complemento (opcional)">
                </div>
            </div>
        <!-- TOTAL DA COMPRA -->
        <!-- <h5 class="bg-dark text-light mt-3 pl-1">Total da Compra</h5>
            <div class="container row p-0 d-flex align-items-center">
                <div class="col-md-6 small">
                    <div id="fretePrazo">
                        <h6>Frete:</h6><span></span>
                        <h6>Prazo: </h6><span></span>
                    </div>
                    <label for="desconto" class="col text-primary">Possui algum cupom de Desconto?</span>
                    <div class="d-flex align-items-center">
                        <input type="text" class="col-8" id="desconto" name="desconto" placeholder="Insira aqui o código de seu cupom">
                        <button class="btn btn-sm text-light col-1 bg-secondary p-0">OK</button>
                    </div>
                </div>
                <div class="col-md-6 text-right font-weight-bolder">
                    <span>Total: </span>
                    <strong>R$<?php echo $subtotal; ?></strong>
                </div>
            </div> -->

        <!-- FORMAS DE PAGAMENTO -->
        <!-- <h5 class="bg-dark pl-1 mt-3 text-light">Formas de Pagamento</h5>
            <div class="form-check d-flex justify-content-center align-items-center">        
                <input type="radio" name="formapg" class="text-center m-1" id="radio-card" value="card"><img src="<?php BASE_URL;?>assets/images/icons/credit_card.png" class="credit_card_img mx-2 rounded bg-white"/>
                <input type="radio" name="formapg" class="text-center m-1" id="radio-boleto" value="boleto"><img src="<?php BASE_URL;?>assets/images/icons/boleto.png" class="boleto_img mx-2 rounded bg-white"/>
            </div> -->

        </fieldset>
        
            <!-- <form action="<?php echo BASE_URL;?>pospay" method="POST">
                <script
                    src="https://www.mercadopago.com.br/integrations/v1/web-tokenize-checkout.js"
                    data-public-key="<?php echo ENV_PUBLIC_KEY;?>"
                    data-transaction-amount="<?php echo $subtotal; ?>">
                </script>
            </form> -->

            <!-- <form action="" method="POST">
                <script
                src="https://www.mercadopago.com.br/integrations/v1/web-payment-checkout.js"
                data-preference-id="<?php echo $preference->id; ?>">
                </script>
            </form> -->
        <!-- </script> -->
        <!-- <input type="submit" class="btn btn-primary btn-block my-3 pagar" value="Fazer Pagamento"> -->
    </form>
    </section>
    
</div>

</section>

