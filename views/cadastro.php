<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css"> <!-- BOOTSTRAP.CSS -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css"> <!-- FOLHA DE ESTILOS PRÓPRIA (STYLE.CSS) -->

<section class="container h-100 d-flex justify-content-center align-items-center flex-column">
    <a href="<?php echo BASE_URL;?>"><img width="200" class="mb-4" src="<?php echo BASE_URL;?>assets/images/lojav1.png" alt="Logo loja virtual 1.0"></a>
    <form class="shadow rounded py-2 px-4 w-100 w-md-75 my-2 bg-light" method="POST" action="<?php echo BASE_URL; ?>cadastro/cadastro">
    <h3 class="lead text-center">CADASTRO</h3>
    <?php if(isset($msg)):?>
        <div class="alert alert-warning"><?php echo $msg; ?></div>
    <?php endif; ?>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="nomeCad">Nome: </label>
            <input type="text" class="form-control <?php if(in_array('nome', $erro)){echo "is-invalid";} ?>" id="nomeCad" name="nomeCad" value="<?php echo $nome; ?>" placeholder="Nome Completo">
        </div>
        <div class="form-group col-md-6">
            <label for="emailCad">Email: </label>
            <input type="email" class="form-control <?php if(in_array('email', $erro)){echo "is-invalid";} ?>" id="emailCad" name="emailCad" value="<?php echo $email; ?>" placeholder="exemplo@mail.com">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="senhaCad">Senha: </label>
            <input type="password" class="form-control <?php if(in_array('senha', $erro)){echo "is-invalid";} ?>" id="senhaCad" name="senhaCad" placeholder="Min. 8 caracteres (letras e números)">
        </div>
        <div class="form-group col-md-6">
            <label for="senha_confirm">Confirme a Senha: </label>
            <input type="password" class="form-control <?php if(in_array('senha', $erro)){echo "is-invalid";} ?>" id="senha_confirm" name="senha_confirm" placeholder="Repita a senha">
        </div>
        
    </div>
    <div class="row">
    <div class="form-group col-md-6">
            <label for="emailCad">Telefone: </label><small> (Opcional)</small>
            <input type="tel" class="form-control" id="telCad" name="telCad" value="<?php echo $telefone; ?>" placeholder="Seu telefone">
        </div>
        <div class="form-group col-md-6">
            <label class="mt-4"></label>
            <input type="submit" class="btn btn-primary btn-block" value="Cadastrar">
            <!-- <button type="submit" class="btn btn-primary btn-block MY-3">Cadastrar</button> -->
            <span class="float-right mt-2">Já possui cadastro? <a href="<?php  echo BASE_URL;?>login">ENTRE!</a></span>
        </div>
    </div>
    
    </form>
</section>

<script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script><!-- JQUERY.JS -->
    <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script> <!-- BOOTSTRAP.JS -->
    <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script> <!-- SCRIPT PRÓPRIO (SCRIPT,JS) -->