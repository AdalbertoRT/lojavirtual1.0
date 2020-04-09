<section class="container">
<div id="finalizar">
    <h2>Informalçoes da sua compra</h2>
    <form method="POST">
        <!-- DADOS DOS PRODUTOS -->
        <fieldset class="border border-secondary rounded p-2">
        <legend class="p-0 ml-4">Produtos</legend>
        <?php if(isset($carrinho)): ?>
        <table class="table table_finalizar">
            <thead class="text-center">
                <th class="p-1 col_foto">Foto</th>
                <th class="p-1 col_nome">Nome</th>
                <th class="p-1">R$</th>
                <th class="p-1 col_qtd">Qtd</th>
                <th class="p-1">Total</th>
            </thead>
            <tbody>
            <?php $subtotal = 0?>
            <?php foreach($carrinho as $prod):?>
                <tr class="text-center">
                    <td class="col_foto"><img width="60" src="<?php echo BASE_URL; ?>assets/images/<?php echo $cat->getCategoria($prod['id']); ?>/<?php echo $prod['imagem']; ?>" alt="<?php echo $prod['nome']; ?>"></td>
                    <td class="col_nome"><?php echo $prod['nome'];?></td>
                    <td>R$ <span class="preco"><?php echo $prod['preco'];?></span></td>
                    <td style="width:100px" class="col_qtd"><input style="width:50px; text-indent: 5px;" @click="totalizar()" class="rounded qtd"  type="number" name="qtd" min="1" max="99" value='1' onKeyDown="if(this.value.length==2) return false;"></td>
                    <td style="width:150px"><strong>R$ {{total}}</strong></td>
                </tr>
                <?php $subtotal += $prod['preco']?>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif;?>
        </fieldset>
        <!-- DADOS DO COMPRADOR -->
        <fieldset class="border border-secondary rounded p-2">
        <legend class="p-0 ml-4">Comprador</legend>
            <div class="row">
                <div class="form-group col-md-4 col-12">
                    <label for="nomeComprador">Nome: </label>
                    <input type="text" class="form-control" id="nomeComprador" placeholder="Nome Completo">
                </div>
                <div class="form-group col-md-4 col-12">
                    <label for="emailComprador">Email: </label>
                    <input type="email" class="form-control" id="emailComprador" placeholder="Seu email">
                </div>
                <div class="form-group col-md-4 col-12">
                    <label for="cpfComprador">CPF: </label>
                    <input type="text" class="form-control" id="cpfComprador" placeholder="000.000.000-00">
                </div>
            </div>
        </fieldset>
        <!-- ENDEREÇO DO COMPRADOR -->
        <fieldset class="border border-secondary rounded p-2">
        <legend class="p-0 ml-4">Endereço de Entrega</legend>
            <div class="row">
                <div class="form-group col-md-4 pr-md-1">
                    <label for="cep">Cep: </label>
                    <input type="text" class="form-control" id="cepCompra" placeholder="00.000-000">
                </div>
                <div class="form-group col-md-6 px-md-1">
                    <label for="rua">Logradouro: </label>
                    <input type="text" class="form-control" id="rua" placeholder="Rua, Av., Estrada etc" title="Rua, Av., Estrada etc">
                </div>
                <div class="form-group col-md-2 pl-md-1">
                    <label for="numero">Nº: </label>
                    <input type="text" class="form-control" id="numero" placeholder="Nº da residência" title="Nº da Residência">
                </div>
                <div class="form-group col-md-7">
                    <label for="cidade">Cidade: </label>
                    <input type="text" class="form-control" id="cidade" placeholder="Cidade">
                </div>
                <div class="form-group col-md-5">
                    <label for="estado">Estado: </label>
                    <input type="text" class="form-control" id="estado" placeholder="Estado">
                </div>
                
                <div class="form-group col-12">
                    <label for="complemento">Complemento: </label>
                    <input type="text" class="form-control" id="complemento" placeholder="Complemento (opcional)">
                </div>
            </div>
        </fieldset>
        <!-- FORMAS DE PAGAMENTO -->
        <fieldset class="border border-secondary rounded p-2">
        <legend class="p-0 ml-4">Formas de Pagamento</legend>            
            <?php foreach($pagamentos as $pag): ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pagamentos" id="pagamentos<?php echo $pag['id'];?>" value="<?php echo $pag['id'];?>">
                <label class="form-check-label" for="pagamentos<?php echo $pag['id'];?>">
                    <?php echo $pag['nome']; ;?>
                </label>
            </div>
            <?php endforeach; ?>
        </fieldset>
        <button type="submit" class="btn btn-primary btn-block my-3">Fazer Pagamento</button>
    </form>
</div>
</section>
