<section class="container">
    <div class="m-1 row">
        <div class="prodImg p-0 col-6 row">
            <div class="thumbnails col-2 m-0">
                <div class="img-thumbnail">
                    <img src="<?php echo BASE_URL; ?>assets/images/<?php echo $categoria->getCategoria($produto['id']);?>/<?php echo $produto['imagem'];?>" alt="<?php echo $produto['nome'];?>">
                </div>
            </div>
            <div class="col-10 p-0">
                <img  src="<?php echo BASE_URL; ?>assets/images/<?php echo $categoria->getCategoria($produto['id']);?>/<?php echo $produto['imagem'];?>" alt="<?php echo $produto['nome'];?>">
            </div>
            
        </div>
        <div class="prodInfo mx-2 col-6">
            <div class="container">
                <h1 id="nomeProd" data-id="<?php echo $produto['id'];?>"><?php echo $produto['nome'];?></h1>
                <p class="my-4"><?php echo $produto['descricao'];?></p>
                <div class="row my-2">
                    <h2 class="col-5">R$ <?php echo $produto['preco'];?></h2>
                    <a href="<?php echo BASE_URL;?>carrinho/add/<?php echo $produto['id'];?>" class="col btn btn-primary font-weight-bold d-flex align-items-center justify-content-center">COMPRAR</a>
                </div>
                <div class="row border mt-2 d-flex align-items-center px-2">
                    <div class="frete col-1 truck"></div>
                    <div class="col-5 d-flex flex-column p-0">
                        <span>Frete e prazo:</span>
                        <a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" target="_blank" class="small w-50">Não sei meu CEP</a>
                    </div>
                    <div class="form-group col-6 d-flex align-items-center m-0">
                        <!-- <div class="row m-0"><small class="balaoCep col-9">Digite seu Cep</small></div> -->
                        <div class="row m-0">
                            <input type="text" class="cepProd form-control form-control-sm col-9 m-0" name="cep" placeholder="00000-000" value="<?php echo isset($_SESSION['frete']) ? $_SESSION['frete']['cep'] : "";?>" onkeypress="$(this).mask('00000-000')">
                            <button class="cepOk btn btn-sm text-light col-3 bg-secondary m-0 p-0">OK</button>
                        </div>
                        
                    </div>
                    <div class="col-12 bg-light fretePara d-flex flex-column">
                        <div class="d-flex"><div class="map_marker m-1"></div><div class="infoFrete m-1"></div></div>
                        <div class="infoPrazo container d-flex flex-column">
                            <div>
                                <small><strong><?php echo $_SESSION['frete']['sedex']['tipo'];?> - </strong><span><?php echo $_SESSION['frete']['sedex']['prazo'];?> a </span> <span><?php echo (intval($_SESSION['frete']['sedex']['prazo']) + 2);?> dias úteis - </span><strong class="text-primary">R$ <?php echo $_SESSION['frete']['sedex']['valor']; ?></strong></small>
                            </div>
                            <div>
                                <small><strong><?php echo $_SESSION['frete']['pac']['tipo'];?> - </strong><span><?php echo $_SESSION['frete']['pac']['prazo'];?> a </span> <span><?php echo (intval($_SESSION['frete']['pac']['prazo']) + 2);?> dias úteis - </span><strong class="text-primary">R$ <?php echo $_SESSION['frete']['pac']['valor']; ?></strong></small>
                            </div> 
                        </div>
                    </div>
                    
                </div>
            </div>            
        </div>
    </div>
</section>
