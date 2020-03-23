<?php 
class Categoria extends model{

    public function listar(){
        $sql = "SELECT nome FROM categorias ORDER BY nome ASC";
        $sql = $this->conn->query($sql);
        $categorias = array();
        if($sql->rowCount() > 0){
            $categorias = $sql->fetchAll();
        }
         return $categorias;
    }

    public function prodsCategoria($cat, $qt = 0){
        if(!empty($cat)){
            if($this->catExists($cat)){
                $sql = "SELECT id, nome, preco, imagem FROM produtos WHERE id_categoria = (select categorias.id from categorias where categorias.nome = :cat) ";
                if($qt > 0){
                    $sql .= "LIMIT $qt";
                }
                $sql = $this->conn->prepare($sql);
                $sql->bindValue(":cat", $cat);
                $sql->execute();
                $produtos = array();
                if($sql->rowCount() > 0){
                    $produtos = $sql->fetchAll();
                }
            }

            return $produtos;
            exit;
        }

        return header("Location: ".BASE_URL);
    }

    public function catExists($cat){
        $cat = addslashes($cat);
        $sql = "SELECT nome FROM categorias WHERE nome = :nome";
        $sql = $this->conn->prepare($sql);
        $sql->bindValue(":nome", $cat);
        $sql->execute();
        if($sql->rowCount() > 0){
           return true;
        }else{
            return false;
        }

    }
    public function getCategoria($cat){
        $cat = addslashes($cat);
        $sql = "SELECT nome FROM categorias WHERE nome = :nome";
        $sql = $this->conn->prepare($sql);
        $sql->bindValue(":nome", $cat);
        $sql->execute();
        $categoria = "";
        if($sql->rowCount() > 0){
            $categoria = $sql->fetch();
            $categoria = $categoria[0];
        }
        return $categoria;

    }
}