
<section class="container">
    <h1><?php echo $categoria;?></h1>
    <div class="prods d-flex justify-content-between flex-wrap py-1">
        <?php foreach($produtos as $prod): ?>
        <a href="<?php echo BASE_URL;?>produto/index/<?php echo $prod['id'];?>">
            <div class="card my-1">
                <img width="200" height="200" src="<?php echo BASE_URL;?>assets/images/<?php echo $prodCat->getCategoria($prod['id']);?>/<?php echo $prod['imagem'];?>" class="card-img-top" alt="<?php echo $prod['nome'];?>">
                <div class="card-body p-0 text-center">
                    <h4 class="card-text"><?php echo $prod['nome'];?></h4>
                    <h4 class="card-text">R$ <?php echo $prod['preco'];?></h4>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
</section>