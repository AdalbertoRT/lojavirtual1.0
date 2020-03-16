<?php
class Produto extends model{

    public function listar($qt = 0){
        $produtos = array();
        $sql = "SELECT id, nome, preco, imagem FROM produtos ORDER BY RAND() ";
        if($qt > 0){
            $sql .= "LIMIT $qt";
        }
        $sql = $this->conn->query($sql);
        if($sql->rowCount() > 0){
            $produtos = $sql->fetchAll();
        }
        return $produtos;
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

    public function removeAcentos($txt){
        if(!empty($txt)){
            $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');

            $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');

            $novoTexto =  str_replace($comAcentos, $semAcentos, $txt);

            return $novoTexto;
        }
        
    }
}