<?php
class produtoController extends controller{

    public function index($id){
        if(!empty($id)){
            $id = addslashes($id);
            $p = new Produto();
            $dados = array(
                "produto" => $p->getProduto($id),
                "categoria" => new Produto()
            );
            return $this->loadTemplate("produto", $dados);
            exit;

        }
        header("Location: ".BASE_URL);
    }
}