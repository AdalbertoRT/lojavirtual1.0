<?php 
class cadastroController extends controller{
    public function index(){
        $dados = array('nome' => '', 'email' => '', 'telefone' => '');

        return $this->loadView("cadastro", $dados);
    }

    public function cadastro(){
        $dados = array('nome' => $_POST['nomeCad'], 'email' => $_POST['emailCad'], 'telefone' => $_POST['telCad']);
        if(isset($_POST['emailCad']) && !empty($_POST['emailCad']) && !empty($_POST['nomeCad']) && !empty($_POST['senhaCad'])){
            $nome = addslashes($_POST['nomeCad']);
            $nome_valido = explode(" ", $nome);
            if(!isset($nome_valido[1])){
                $dados['msg'] = "Nome incompleto!";
                $dados['erro'] = array("nome");
                return $this->loadView("cadastro", $dados);
            } 
            $email = addslashes($_POST['emailCad']);
            $dados = [ 'nome' => $_POST['nomeCad'], 'email' => $_POST['emailCad'], 'telefone' => $_POST['telCad'] ];
            $e = new Login();
            if($e->existeEmail($email) == false){
                $validaSenha = $this->validaSenha($_POST['senhaCad'], $_POST['senha_confirm']);
                if($validaSenha == 'valida'){
                    $senha = MD5($_POST['senhaCad']);
                    $telefone = addslashes($_POST['telCad']);
                
                    $c = new Cadastro();
                    $c->cadastrar($nome, $email, $senha, $telefone);
                                        
                    // header("Location: ".BASE_URL."confcadastro/index/".$email);
                    return $this->loadView("confcadastro", $dados);
                }else{
                    $dados['msg'] = $validaSenha;
                    $dados['erro'] = array('senha');
                }       
            }else{
                $dados['msg'] = "Este E-mail já está em uso!";
            }
        }else{
                $dados['msg'] = "Preencha todos os campos obrigatórios!";
                $dados['erro'] = array();
                if($dados['nome'] == ""){
                    array_push($dados['erro'], 'nome');
                }
                if($dados['email'] == ""){
                    array_push($dados['erro'], 'email');
                } 
                array_push($dados['erro'], 'senha');
        }
        return $this->loadView("cadastro", $dados);
    }

    public function validaSenha($senha, $senha_confirm){
        $s = filter_var($senha, FILTER_SANITIZE_NUMBER_INT);
        $msg = "valida";
        if(empty($senha)){
            $msg = "Preencha o campo senha!";
            return $msg;
        
        }
        if(strlen($senha) < 8){
            $msg = "A senha deve conter no mínimo 8 caracteres!";
            return $msg;
        
        }       
        if( !is_numeric($s) || preg_replace('/[0-9]/', '', $senha) == ""){
            $msg = "A senha deve conter letras e números!";
            return $msg;
        
        }
        if($senha != $senha_confirm){
            $msg = "As senhas não conferem!";
            return $msg;
        
        }
                            
        return $msg;
    }
}