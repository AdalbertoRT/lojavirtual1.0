<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css"> <!-- BOOTSTRAP.CSS -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css"> <!-- FOLHA DE ESTILOS PRÓPRIA (STYLE.CSS) -->

<section class="container d-flex justify-content-center align-items-center flex-column">
<a href="<?php echo BASE_URL;?>"><img width="200" class="mb-4" src="<?php echo BASE_URL;?>assets/images/lojav1.png" alt="Logo loja virtual 1.0"></a>
    <h2 class="mb-4">Enviamos um email para você confirmar seu cadastro.</h2>
    <?php 
        $mail = explode("@", $email);
        $mail = explode(".", $mail[1]);
        $mail = "http://www.".$mail[0].".com";
    ?>
    <a href="<?php echo $mail;?>" target="blank" class="btn btn-primary my-4">Ir para meu E-mail</a>
    <a href="<?php echo BASE_URL;?>login" class="btn btn-success">Ir para Login</a>
</section>

<script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script><!-- JQUERY.JS -->
    <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script> <!-- BOOTSTRAP.JS -->
    <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script> <!-- SCRIPT PRÓPRIO (SCRIPT,JS) -->