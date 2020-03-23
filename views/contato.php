<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css"> <!-- BOOTSTRAP.CSS -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css"> <!-- FOLHA DE ESTILOS PRÓPRIA (STYLE.CSS) -->

<section class="container d-flex justify-content-center align-items-center flex-column">
    <a href="<?php echo BASE_URL;?>"><img width="200" class="mb-4" src="<?php echo BASE_URL;?>assets/images/lojav1.png" alt="Logo loja virtual 1.0"></a>
    <div class="contatos row w-100">
        <div class="telefones col-3 rounded shadow bg-secondary text-light">
            <h3 class="lead text-center my-2 mb-4">TELEFONES</h3>
                <p class="text-center">17 99703-3384</p>
                <p class="text-center">17 99145-5095</p>
            <h3 class="lead text-center my-4">E-MAIL</h3>
                <p class="text-center">lojav1@mail.com.br</p>
        </div>
        <div class="formContato col-6 shadow rounded bg-light">
            <form class="p-1" method="POST">
                <?php if(!empty($msg)):?>
                    <div class="alert alert-success" v-bind="apagamsg()"><?php echo $msg;?></div>
                <?php endif;?>
                <h3 class="lead text-center my-2">CONTATO</h3>
                <div class="form-group">
                    <label for="contatoNome">Nome: </label>
                    <input type="text" class="form-control" name="contatoNome" id="contatoNome" placeholder="Seu nome" required>
                </div>
                <div class="form-group">
                    <label for="contatoEmail">Email: </label>
                    <input type="email" class="form-control" name="contatoEmail" id="contatoEmail" placeholder="exemplo@mail.com" required>
                </div>
                <div class="form-group">
                    <label for="contatoMensagem">Mensagem: </label><br>
                    <textarea name="contatoMensagem" name="contatoMensagem" id="contatoMensagem" class="w-100" rows="6" placeholder="Sua mensagem" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
            </form>
        </div>
        <div class="redesSociais col-3 rounded shadow bg-secondary text-light">
            <h3 class="lead text-center my-2 mb-4">REDES SOCIAIS</h3>
                <ul>
                    <a href=""><img width="40" src="<?php echo BASE_URL;?>assets/images/icons/facebook.png" alt="Facebook"></a>
                    <a href=""><img width="40" src="<?php echo BASE_URL;?>assets/images/icons/instagram.png" alt="Instagram"></a>
                    <a href=""><img width="40" src="<?php echo BASE_URL;?>assets/images/icons/youtube.png" alt="Youtube"></a>
                    <a href=""><img width="40" src="<?php echo BASE_URL;?>assets/images/icons/linkedin.png" alt="Linkedin"></a>
                </ul>
            
        </div>
    </div>
    
</section>

<script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script><!-- JQUERY.JS -->
<script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script> <!-- BOOTSTRAP.JS -->
<script src="<?php echo BASE_URL; ?>assets/js/script.js"></script> <!-- SCRIPT PRÓPRIO (SCRIPT,JS) -->
