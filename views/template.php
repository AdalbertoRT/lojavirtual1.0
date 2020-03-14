<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css"> <!-- BOOTSTRAP.CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css"> <!-- FOLHA DE ESTILOS PRÓPRIA (STYLE.CSS) -->
    <title>Document</title>
</head>
<body>
    <!-- CABEÇALHO DO SITE (HEADER) -->
    <header>
        <div>
            <div class="container text-light">
                <a href="<?php echo BASE_URL; ?>"><img width="200" src="<?php echo BASE_URL;?>assets/images/lojav1.png" alt="Loja Virtual 1.0" title="Loja Virtual 1.0"></a>
            </div>
            <!-- MENU DO SITE -->
            <div class="menu bg-dark">
                <nav class="navbar navbar-expand-lg container">
                    
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Empresa</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contato</a>
                        </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </nav>
            </div>
            
        </div>
    </header>

    <!-- CONTEUDO DO SITE (ex: SECTION) -->
    <?php $this->loadView($viewName, $viewData) ?>

    <!-- RODAPÉ DO SITE (FOOTER) -->
    <footer class="w-100">
    <div class="bg-dark p-1">
        <div class="container text-light text-center">
            <h6>&copy; Todos os Direitos Reservados</h6>
        </div>
    </div>
    </footer>

    <!-- SCRIPTS -->
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script><!-- JQUERY.JS -->
    <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script> <!-- BOOTSTRAP.JS -->
    <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script> <!-- SCRIPT PRÓPRIO (SCRIPT,JS) -->
</body>
</html>
