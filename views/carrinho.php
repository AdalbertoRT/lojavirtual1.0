<section class="container">
    <?php if(isset($carrinho)): ?>
        <?php print_r($_SESSION['carrinho']);?>
    <table class="table table-striped">
        <thead class="bg-secondary text-light">
            <th>Imagem</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Ações</th>
        </thead>
        <tbody>
        <?php $subtotal = 0?>
        <?php foreach($carrinho as $prod):?>
            <tr>
                <td><img width="60" src="<?php echo BASE_URL; ?>assets/images/<?php echo $cat->getCategoria($prod['id']); ?>/<?php echo $prod['imagem']; ?>" alt="<?php echo $prod['nome']; ?>"></td>
                <td><?php echo $prod['nome'];?></td>
                <td>R$ <?php echo $prod['preco'];?></td>
                <td><a href="<?php echo BaSE_URL; ?>/carrinho/excluirItem" onclick="return confirm('Deseja excluir este item do carrinho?')">Excluir</a></td>
            </tr>
            <?php $subtotal += $prod['preco']?>
        <?php endforeach; ?>
            <tr class="bg-secondary text-light">
                <td colspan=2>
                    <a href="<?php echo BASE_URL; ?>" class="btn btn-sm btn-warning text-white">Continuar Comprando</a>
                    <span class="float-right">Subtotal: </span> 
                </td>
                <td colspan=2 class="font-weight-bold h5 text-light">
                    <span>R$ <?php echo $subtotal?></span> 
                    <a href="" class="btn btn-sm btn-success float-right">Finalizar a Compra</a>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="clear:both";></div>
    <?php else:?>
    <div class="w-100 text-center h3 my-4">Não há itens no carrinho!</div>
    <?php endif;?> 
</section>