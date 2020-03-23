<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css"> <!-- BOOTSTRAP.CSS -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css"> <!-- FOLHA DE ESTILOS PRÓPRIA (STYLE.CSS) -->

<section class="container h-100 d-flex justify-content-center align-items-center flex-column">
    <a href="<?php echo BASE_URL;?>"><img width="200" class="mb-4" src="<?php echo BASE_URL;?>assets/images/lojav1.png" alt="Logo loja virtual 1.0"></a>
    <form class="shadow rounded p-4 w-75 my-2 bg-light">
    <h3 class="lead text-center">CADASTRO</h3>
    <div class="row">
        <div class="form-group col-6">
            <label for="nomeCad">Nome: </label>
            <input type="text" class="form-control" id="nomeCad" placeholder="Seu primeiro nome">
        </div>
        <div class="form-group col-6">
            <label for="sobrenomeCad">Sobrenome: </label>
            <input type="text" class="form-control" id="sobrenomeCad" placeholder="Todo seu sobrenome">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label for="emailCad">Email: </label>
            <input type="email" class="form-control" id="emailCad" placeholder="exemplo@mail.com">
        </div>
        <div class="form-group col-6">
            <label for="emailCad">Telefone: </label><small> (Opcional)</small>
            <input type="tel" class="form-control" id="telCad" placeholder="Seu telefone">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label for="senhaCad">Senha: </label>
            <input type="password" class="form-control" id="senhaLogin" placeholder="Min. 8 caracteres">
        </div>
        <div class="form-group col-6">
            <label for="senha_confirm">Confirme a Senha: </label>
            <input type="password" class="form-control" id="senha_confirm" placeholder="Repita a senha">
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary btn-block MY-3">Cadastrar</button>
    <span class="float-right">Ou então <a href="<?php  echo BASE_URL;?>login">ENTRE!</a></span>
    </form>
</section>

<script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script><!-- JQUERY.JS -->
    <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script> <!-- BOOTSTRAP.JS -->
    <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script> <!-- SCRIPT PRÓPRIO (SCRIPT,JS) -->