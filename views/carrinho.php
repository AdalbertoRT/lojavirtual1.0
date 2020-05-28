<section class="container mt-2">
    <?php if(isset($carrinho)):?>
    <table class="table table-striped cart">
        <thead class="bg-secondary text-light text-center">
            <th width="15%">Imagem</th>
            <th>Nome</th>
            <th width="15%">Quantidade</th>
            <th width="15%">Preço</th>
            <th width="15%">Ações</th>
        </thead>
        <tbody class="text-center">
        <?php $subtotal = 0?>
        <?php foreach($carrinho as $prod):?>
        
            <tr class="itemsCart" data-id="<?php echo $prod['id']; ?>">
                <td><img width="60" src="<?php echo BASE_URL; ?>assets/images/<?php echo $cat->getCategoria($prod['id']); ?>/<?php echo $prod['imagem']; ?>" alt="<?php echo $prod['nome']; ?>"></td>
                <td><?php echo $prod['nome'];?></td>

                <!-- LISTAR A QUANTIDADE NO CARRINHO -->
                             
                <td class="col_qtd small"><button class="qtdMenos">-</button><span class="rounded qtd" data-estoque="<?php echo $prod['quantidade'];?>"><?php echo $_SESSION['carrinho']['qtds'][$prod['id']]; ?></span><button class="qtdMais">+</button></td>

                <td>R$ <span class="preco"><?php echo $prod['preco'] * $_SESSION['carrinho']['qtds'][$prod['id']];?></span></td>
                <td><a href="<?php echo BASE_URL; ?>/carrinho/excluirItem/<?php echo $prod['id']; ?>" onclick="return confirm('Deseja excluir este item do carrinho?')">Excluir</a></td>
            </tr>
            <?php $subtotal += $prod['preco'] * $_SESSION['carrinho']['qtds'][$prod['id']]?>
        <?php endforeach; ?>
            <tr class="bg-secondary text-light">
                <td>
                    <a href="<?php echo BASE_URL; ?>" class="btn btn-sm btn-warning text-white">Voltar a Loja</a>
                </td>
                <td colspan=2><span class="float-right">Subtotal: </span></td>
                <td class="font-weight-bold h5 text-light">
                    R$ <span class="subtotal"><?php echo $subtotal?></span> 
                </td>
                <td><a href="<?php echo BASE_URL; ?>finalizar" class="btn btn-sm btn-success finalizar">Finalizar Compra</a></td>
               
            </tr>
        </tbody>
    </table>
    <div style="clear:both";></div>
    <?php else:?>
    <div class="w-100 text-center h3 my-4">Não há itens no carrinho!</div>
    <?php endif;?> 
</section>