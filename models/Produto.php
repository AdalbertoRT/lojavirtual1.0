<?php
class Produto extends model{

    public function listar($filtro, $qt = 0){
        $produtos = array();
        $sql = "SELECT id, nome, preco, imagem FROM produtos ";
        if($filtro != ''){
            $sql = $sql." WHERE nome LIKE '%$filtro%'";
        }
        $sql = $sql." ORDER BY RAND() ";
        if($qt > 0){
            $sql .= "LIMIT $qt";
        }
        $sql = $this->conn->query($sql);
        if($sql->rowCount() > 0){
            $produtos = $sql->fetchAll();
        }else{
            header("Location: ".Base_URL);
        }
        return $produtos;
    }

    public function getProduto($id){
        if(!empty($id)){
            if($this->prodExists($id)){
                $sql = "SELECT * FROM produtos WHERE id = :id";
                $sql = $this->conn->prepare($sql);
                $sql->bindValue(":id", $id);
                $sql->execute();
                $produto = array();
                if($sql->rowCount() > 0){
                    $produto = $sql->fetch();
                }
                return $produto;
            }
        }
    }

    public function getCategoria($id){
        $sql ="SELECT nome FROM categorias WHERE id = (select produtos.id_categoria from produtos where id = :id)";
        $sql = $this->conn->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        $categoria = "";
        if($sql->rowCount() > 0){
            $categoria = $this->removeAcentos($sql->fetch());
            $categoria = strtolower($categoria[0]);
        }
        return $categoria;
    }

    public function prodExists($id){
        $sql = "SELECT id FROM produtos WHERE id = :id";
        $sql = $this->conn->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function removeAcentos($txt){
        if(!empty($txt)){
            $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');

            $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');

            $novoTexto =  str_replace($comAcentos, $semAcentos, $txt);

            return $novoTexto;
        }
        
    }

    public function getQtd($id){
        $qtd = 0;
        $sql = "SELECT quantidade FROM produtos WHERE id = $id";
        $sql = $this->conn->query($sql);
        if($sql->rowCount() > 0){
            $qtd = $sql->fetch();
        }
        return intval($qtd[0]);
    }

    public function getPreco($id){
        $preco = 0;
        $sql = "SELECT preco FROM produtos WHERE id = $id";
        $sql = $this->conn->query($sql);
        if($sql->rowCount() > 0){
            $preco = $sql->fetch();
        }
        return $preco[0];
    }
}