<?php
class Desconto extends model{

    public function getDesconto($desc){
        $desconto = 0;
        $sql = "SELECT valor FROM descontos WHERE codigo = :codigo";
        $sql = $this->conn->prepare($sql);
        $sql->bindValue(":codigo", $desc);
        $sql->execute();
        if($sql->rowCount() > 0){
            $desconto = $sql->fetch();
            $desconto = intval($desconto[0]);
        }
        return $desconto;
    }

}