<?php 
class loginController extends controller{

    public function index(){
        $dados = array();

        $this->loadView("login", $dados);
    }

    public function login(){
        $dados = array();
        if(isset($_POST['emailLogin']) && !empty($_POST['emailLogin'])){
            $email = addslashes($_POST['emailLogin']);
            $senha = MD5($_POST['senhaLogin']);
            $login = new Login();
            if($login->existeEmail($email)){
                if($login->checkCredentials($email, $senha)){
                    $usuario = $login->logar($email, $senha);
                    $_SESSION['logado'] = $usuario;
                    if(isset($_SESSION['notLogged'])){
                        unset($_SESSION['notLogged']);
                        header("Location: ".BASE_URL."finalizar");exit;  
                    }
                    header("Location: ".BASE_URL);
                }else{
                    $dados['msg'] = "<strong>E-MAIL</strong> e/ou <strong>SENHA</strong> Inválidos!";
                    $this->loadView("login", $dados);
                }
            }else{
                $dados['msg'] = "Este <strong>E-MAIL</strong> não esta cadastrado!";
                $this->loadView("login", $dados);
            }
        }else{
            $dados['msg'] = "Insira E-mail e Senha!";
                $this->loadView("login", $dados);
        }
    }
}