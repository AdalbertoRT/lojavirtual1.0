<section class="container">
    <div class="m-1 d-flex">
        <div class="prodImg p-0">
            <img  src="<?php echo BASE_URL; ?>assets/images/<?php echo $categoria->getCategoria($produto['id']);?>/<?php echo $produto['imagem'];?>" alt="<?php echo $produto['nome'];?>">
        </div>
        <div class="prodInfo px-3">
            <h1><?php echo $produto['nome'];?></h1>
            <p class="my-4"><?php echo $produto['descricao'];?></p>
            <h2 class="my-3">R$ <?php echo $produto['preco'];?></h2>
            <a href="<?php echo BASE_URL;?>carrinho/add/<?php echo $produto['id'];?>">Adicionar ao carrinho</a>
        </div>
    </div>
</section>
