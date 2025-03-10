<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css"> <!-- BOOTSTRAP.CSS -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css"> <!-- FOLHA DE ESTILOS PRÓPRIA (STYLE.CSS) -->

<section class="container h-100 d-flex justify-content-center align-items-center flex-column">
    <a href="<?php echo BASE_URL;?>"><img width="200" class="mb-4" src="<?php echo BASE_URL;?>assets/images/lojav1.png" alt="Logo loja virtual 1.0"></a>
    <?php if(isset($msg)): ?>
    <div class="alert alert-warning"><?php echo $msg; ?></div>
    <?php endif; ?>
    <form class="shadow rounded p-4 w-50 my-2 bg-light" method="POST" action="<?php echo BASE_URL; ?>login/login">
    <h3 class="lead text-center">LOGIN</h3>
    <div class="form-group">
        <label for="emailLogin">Email: </label>
        <input type="email" class="form-control" id="emailLogin" name="emailLogin" placeholder="exemplo@mail.com" autofocus>
    </div>
    <div class="form-group">
        <label for="senhaLogin">Senha: </label>
        <input type="password" class="form-control" id="senhaLogin" name="senhaLogin" placeholder="********">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="manter_conectado" name="manter_conectado">
        <label class="form-check-label" for="manter_conectado">Manter Conectado</label>
    </div>
    <button type="submit" class="btn btn-primary btn-block MY-3">Entrar</button>
    <span class="float-right">Ou então <a href="<?php  echo BASE_URL;?>cadastro">CADASTRE-SE!</a></span>
    </form>
</section>

<script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script><!-- JQUERY.JS -->
    <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script> <!-- BOOTSTRAP.JS -->
    <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script> <!-- SCRIPT PRÓPRIO (SCRIPT,JS) -->