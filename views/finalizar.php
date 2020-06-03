<section class="container">
<div id="finalizar">
    <?php if(isset($erro)): ?>
        <div class="alert alert-danger mt-2 mb-0"><?php echo $erro; ?></div>
    <?php endif; ?>
    <form method="POST" id="pagar" action="<?php echo BASE_URL; ?>finalizar/pagar">
        <!-- DADOS DOS PRODUTOS -->
        <fieldset class="border border-secondary rounded px-4 py-2">
        <legend class="p-0 ml-4">Informações da Compra</legend>
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
        <h5 class="bg-dark text-light mt-3 pl-1">Total da Compra</h5>
            <div class="container row p-0 d-flex align-items-center">
                <div class="col-md-6 small">
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
            </div>

        <!-- FORMAS DE PAGAMENTO -->
        <h5 class="bg-dark pl-1 mt-3 text-light">Formas de Pagamento</h5>
            <div class="form-check d-flex justify-content-around">        
            <?php foreach($pagamentos as $pag): ?>
                <div>
                    <input class="form-check-input" type="radio" name="pagamentos" id="pagamentos<?php echo $pag['id'];?>" value="<?php echo $pag['id'];?>">
                    <label class="form-check-label" for="pagamentos<?php echo $pag['id'];?>">
                        <?php echo $pag['nome'];?>
                    </label>
                </div>
            <?php endforeach; ?>
            </div>

        </fieldset>
        <input type="submit" class="btn btn-primary btn-block my-3 pagar" value="Fazer Pagamento">
    </form>
</div>
</section>

