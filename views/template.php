<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css"> <!-- BOOTSTRAP.CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css"> <!-- FOLHA DE ESTILOS PRÓPRIA (STYLE.CSS) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> -->
    <title>Loja Virtual 1.0</title>
</head>
<body>
    <!-- CABEÇALHO DO SITE (HEADER) -->
    <header>
        <div>
            <div class="container text-light row m-auto d-flex justify-content-between">
                <a href="<?php echo BASE_URL; ?>" class="col-12 col-md-4 p-0"><img width="200" src="<?php echo BASE_URL;?>assets/images/lojav1.png" alt="Loja Virtual 1.0" title="Loja Virtual 1.0"></a>
                <ol class="breadcrumbsCarrinho float-right text-dark align-self-center col-md-4 d-flex justify-content-between">
                    <li><a href="<?php echo BASE_URL;?>carrinho">Carrinho</a></li>
                    <li><a href="<?php echo BASE_URL;?>login">Identificação</a></li>
                    <li><a href="<?php echo BASE_URL;?>finalizar">Pagamento</a></li>
                </ol>
                <form class="form-inline my-2 my-lg-0 col-8 col-md-5 p-0" method="GET" action="<?php echo BASE_URL; ?>">
                    <input class="form-control mr-sm-2 w-75" type="search" placeholder="O que você busca?" aria-label="Search" name="filtro">
                    <button class="btn my-2 my-sm-0 buscar" type="submit"></button>
                </form>
                <nav class="navbar col-4 col-md-3 p-0 d-flex justify-content-end">
                <?php if(isset($_SESSION['logado'])): ?>
                    <?php  
                        $nome = $_SESSION['logado']['nome'];
                        $nome = explode(" ", $nome);
                        if(strlen($nome[0] < 4)){
                            $nome = $nome[0]." ".$nome[1];
                        }else{
                            $nome = $nome[0];
                        }                
                        
                    ?>
                    <div class="dropdown">
                        <button class="nav-item btn btn-sm p-1 m-1 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $nome;?>
                        </button>
                        <div class="dropdown-menu menu_user" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item p-1" href="#">Meus Pedidos</a>
                            <a class="dropdown-item p-1" href="#">Meu Carrinho</a>
                            <a class="dropdown-item p-1" href="#">Meus Favoritos</a>
                            <a class="dropdown-item p-1" href="#">Lista de Desejo</a>
                            <hr class="m-0">
                            <a class="dropdown-item p-1 m-0" href="<?php echo BASE_URL;?>sair" onclick="return confirm('Deseja fazer logout');">Sair</a>                            
                        </div>
                    </div>
                <?php else: ?>
                    <button class="nav-item btn  btn-sm p-0 m-1"><a href="<?php echo BASE_URL;?>login" class="nav-link p-1">Entrar</a></button>
                    <button class="nav-item btn  btn-sm p-0 m-1"><a href="<?php echo BASE_URL;?>cadastro" class="nav-link p-1">Cadastrar</a></button>
                <?php endif;?>
                </nav>
            </div>
            <!-- MENU DO SITE -->
            <div class="menu bg-dark">
                <nav class="navbar navbar-expand-lg container p-0">
                    
                    <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse menu container" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo BASE_URL;?>">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <?php foreach($categorias as $cat): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL;?>categoria/index/<?php echo $cat['nome'];?>"><?php echo $cat['nome'];?></a>
                        </li>
                        <?php endforeach; ?>
                        
                        </ul>
                        <!-- CARRINHO -->
                        <a href="<?php echo BASE_URL;?>carrinho" class="text-light mr-4 carrinho">
                            <img width="50" src="<?php echo BASE_URL;?>assets/images/icons/cart1.png" alt="carrinho de compras">
                            <?php if(isset($_SESSION['carrinho']) && (count($_SESSION['carrinho']) > 2) ):?>
                            <span id="qtCarrinho" class="text-center" style="<?php echo (count($_SESSION['carrinho']) < 1) ? 'display:none' : '';  ?>"><?php echo count($_SESSION['carrinho']) - 2;?></span>
                            <?php endif;?>
                        </a>
                        
                    </div>
                </nav>
            </div>
                
        </div>
    </header>

    <!-- CONTEUDO DO SITE (ex: SECTION) -->
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>

    <!-- RODAPÉ DO SITE (FOOTER) -->
    <footer class="w-100 bg-dark p-1 d-flex flex-column">
            <div class="container text-light d-flex justify-content-between flex-wrap p-2">
                <div id="atendimento">
                    <h6 class="mb-3">Atendimento</h6>
                    <ul>
                        <li><a href="<?php echo BASE_URL;?>contato">Contato</a></li>
                    </ul>
                </div>
                <div id="institucional">
                    Institucional
                </div>
                <div id="forma-pgt-selos">
                    <div id="forma-pgt">
                        Forma de Pagamentos
                    </div>
                    <div id="selos">
                        Selos de segurança
                    </div>
                </div>
            </div>
            <hr class="bg-light w-100">
            <small class="p-0 container text-light text-center">Arteix Sistemas LTDA CNPJ: 17.061.424/0001-69 - Rua Zaqui Hallal, 341, São José do Rio Preto - SP CEP 15041-250</small>
            <hr class="bg-light w-100">
            <small class="p-0 container text-light text-center">Ofertas válidas enquanto durarem nossos estoques | Imagens meramente ilustrativas | Vendas sujeitas a análise e confirmação de dados pela empresa. &copy; Todos os Direitos Reservados lojav1.com.br</small>
            <div class="container text-light text-center mt-2"><small>Desenvovido por<small> <h6><strong>Arteix Sistemas</strong></h6></div>
    
    </footer>

    <!-- SCRIPTS -->
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script><!-- JQUERY.JS -->
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.mask.js"></script><!-- JQUERY.JS -->
    <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script> <!-- BOOTSTRAP.JS -->
    <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script> <!-- SCRIPT PRÓPRIO (SCRIPT,JS) -->
    <script src="<?php echo BASE_URL; ?>libs/js/script_mp.js"></script>
</body>
</html>
