<?php
class Carrinho extends model{
    public function listar($prods){
        if(!empty($prods)){
            $sql = "SELECT * FROM produtos WHERE id IN (".implode(",", $prods).")";
            $sql = $this->conn->query($sql);
            $itens = array();
            if($sql->rowCount() > 0){
                $itens = $sql->fetchAll();
            }
            return $itens;
        }
    }
    // public function listar($idCart){
    //     if(!empty($idCart)){
    //         $sql = "SELECT carrinho.*, produtos.*  FROM carrinho INNER JOIN produtos ON carrinho.idProd = produtos.id WHERE carrinho.id = '$idCart'";
    //         $sql = $this->conn->query($sql);
    //         $itens = array();
    //         if($sql->rowCount() > 0){
    //             $itens = $sql->fetchAll();
    //         }
    //         return $itens;
    //     }
    // }

    // public function adicionar($id, $idProd, $qtd){
    //     if(!empty($id)){
    //         $sql = "INSERT INTO carrinho (id, idProd, qtd) VALUES (:id, :idProd, :qtd)";
    //         $sql = $this->conn->prepare($sql);
    //         $sql->execute(array(":id" => $id, ":idProd" => $idProd, ":qtd" => $qtd));
    //     }
    // }

    public function getParcelas(){
        $parcelas = 1;
        $sql = "SELECT taxa FROM parcelamentos";
        $sql = $this->conn->query($sql);
        if($sql->rowCount() > 0){
            $parcelas = $sql->fetchAll();
        }
        return $parcelas;
    }
}
