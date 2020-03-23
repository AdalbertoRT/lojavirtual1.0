<?php 
class categoriaController extends controller{

    public function index($cat = ""){
        $dados = array();
        if(!empty($cat)){
            $c = new Categoria();
            $dados = array(
                "categoria" => $c->getCategoria($cat),
                "produtos" => $c->prodsCategoria($cat, 10),
                "prodCat" => new Produto()
            );
            return $this->loadTemplate("categoria", $dados);            
        }else{
            return $this->loadTemplate("erro404", $dados);
        } 
    }
}