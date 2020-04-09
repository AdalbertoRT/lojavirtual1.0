<section class="container">
<div id="finalizar">
    <form method="POST">
        <!-- DADOS DOS PRODUTOS -->
        <fieldset class="border border-secondary rounded px-4 py-2">
        <legend class="p-0 ml-4">Informações da Compra</legend>
        <?php if(isset($carrinho)): ?>
        <h5 class="bg-light pl-1">Produtos</h5>
        <table class="table table_finalizar m-0">
            <thead class="text-center small">
                <th class="p-0 col_foto">Foto</th>
                <th class="p-0 col_nome">Nome</th>
                <th class="p-0">R$</th>
                <th class="p-0 col_qtd">Qtd</th>
                <th class="p-0">Total</th>
            </thead>
            <tbody>
            <?php $subtotal = 0?>
            <?php foreach($carrinho as $prod):?>
                <tr class="text-center">
                    <td class="col_foto"><img width="40" src="<?php echo BASE_URL; ?>assets/images/<?php echo $cat->getCategoria($prod['id']); ?>/<?php echo $prod['imagem']; ?>" alt="<?php echo $prod['nome']; ?>"></td>
                    <td class="col_nome small"><?php echo $prod['nome'];?></td>
                    <td class="small">R$ <span class="preco"><?php echo $prod['preco'];?></span></td>
                    <td style="width:100px" class="col_qtd small"><input style="width:50px; text-indent: 5px;" @click="totalizar()" class="rounded qtd"  type="number" name="qtd" min="1" max="99" value='1' onKeyDown="if(this.value.length==2) return false;"></td>
                    <td style="width:150px" class="small"><strong>R$ {{total}}</strong></td>
                </tr>
                <?php $subtotal += $prod['preco']?>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif;?>
       
        <!-- DADOS DO COMPRADOR -->
        <h5 class="bg-light pl-1">Comprador</h5>
            <div class="container row p-0">
                <div class="small col-sm-4">Nome: <strong><?php  echo $_SESSION['logado']['nome'];?></strong></div>
                <div class="small col-sm-4">Email: <strong><?php  echo $_SESSION['logado']['email'];?></strong></div>
                <div class="small col-sm-4">Telefone: <strong><?php  echo $_SESSION['logado']['telefone'];?></strong></div>
                <div class="small container d-flex align-items-center col-12 d-flex mt-3"><span>CPF:  </span><input type="text" class="form-control form-control-sm ml-2 col-md-6" id="cpfComprador" placeholder="000.000.000-00"></div>
                <small class="text-primary mb-4 ml-3">Digite seu CPF para emissão da nota fiscal.</small>
               
            </div>
      
        <!-- ENDEREÇO DO COMPRADOR -->
        <h5 class="bg-light pl-1">Endereço de Entrega</h5>
            <div class="row">
                <div class="form-group col-md-4 pr-md-1 m-0">
                    <label for="cep" class="small">Cep: </label>
                    <input type="text" class="form-control form-control-sm" id="cep" name="cep" placeholder="00000-000" value="<?php echo $_SESSION['logado']['cep'];?>">
                </div>
                <div class="form-group col-md-6 px-md-1 m-0">
                    <label for="rua" class="small">Logradouro: </label>
                    <input type="text" class="form-control form-control-sm" id="logradouro" name="logradouro" placeholder="Rua, Av., Estrada etc" title="Rua, Av., Estrada etc" disabled>
                </div>
                <div class="form-group col-md-2 pl-md-1 m-0">
                    <label for="numero" class="small">Nº: </label>
                    <input type="text" class="form-control form-control-sm" id="numero" name="numero" placeholder="Nº da residência" title="Nº da Residência">
                </div>
                <div class="form-group col-md-4 m-0 pr-md-1">
                    <label for="cidade" class="small">Bairro: </label>
                    <input type="text" class="form-control form-control-sm" id="bairro" name="bairro" placeholder="Bairro" disabled>
                </div>
                <div class="form-group col-md-6 m-0 px-md-1">
                    <label for="cidade" class="small">Cidade: </label>
                    <input type="text" class="form-control form-control-sm" id="cidade" name="cidade" placeholder="Cidade" disabled>
                </div>
                <div class="form-group col-md-2 m-0 pl-md-1">
                    <label for="uf" class="small">Estado: </label>
                    <select class="form-control form-control-sm" id="uf" disabled>
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
        
        <!-- FORMAS DE PAGAMENTO -->
        <h5 class="bg-light pl-1 mt-3">Formas de Pagamento</h5>
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
        <button type="submit" class="btn btn-primary btn-block my-3">Fazer Pagamento</button>
    </form>
</div>
</section>
