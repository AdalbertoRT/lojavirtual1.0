<?php
class Pagamentos extends model{
    public function getPagamentos(){
        $array = array();
        $sql = "SELECT * FROM pagamentos";
        $sql = $this->conn->query($sql);
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }
}