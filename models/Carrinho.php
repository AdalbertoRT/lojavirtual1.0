<?php
class Carrinho extends model{
    public function listar($prods){
        if(!empty($prods)){
            $sql = "SELECT id, imagem, nome, preco FROM produtos WHERE id IN (".implode(",", $prods).")";
            $sql = $this->conn->query($sql);
            $itens = array();
            if($sql->rowCount() > 0){
                $itens = $sql->fetchAll();
            }
            return $itens;
        }

    }
}