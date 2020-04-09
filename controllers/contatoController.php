<?php 
class contatoController extends controller {
    public function index(){
        $dados = array('msg' => '');
        if(isset($_POST['contatoNome']) && !empty($_POST['contatoNome'])){
            $nome = addslashes($_POST['contatoNome']);
            $email = addslashes($_POST['contatoEmail']);
            $msg = addslashes($_POST['contatoMensagem']);

            $html = "Nome: ".$nome."<br/>\r\nEmail: ".$email."<br/>\r\nMensagem: ".$msg;

            $headers = "From: lojav1@mail.com.br"."\r\n";
            $headers .= "Reply-To: ".$email."\r\n";
            $headers .= "X-Mailer: PHP/".phpversion();

            mail("lojav1@mail.com.br", "Contato pelo site em ".date('d/m/Y'), $html, $headers);

            $dados['msg'] = "Mensagem enviada com sucesso!";
        }

        return $this->loadView("contato", $dados);
    }
}