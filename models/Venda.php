<?php
class Venda extends model{

    public function setVenda($id_usuario, $endereco, $valor, $forma_pg, $prods, $qtds, $data_venda){
        /*
        STATUS: 
            0 = Aguardando Pagamento;
            1 = Pagamento Aprovado;
            2 = Cancelado
        */
        $status = 0;
        $pg_link = '';

        /* 
        AQUI INTEGRAÇÃO COM PAGAMENTOS
        */

        $sql = "INSERT INTO vendas SET id_usuario = ?, endereco = ?, valor = ?, forma_pg = ?, status_pg = ?, pg_link = ?, data_venda = ?";
        $sql = $this->conn->prepare($sql);
        $sql->execute(array($id_usuario, $endereco, $valor, $forma_pg, $status, $pg_link, $data_venda));

        $id_venda = $this->conn->lastInsertId();

        foreach($prods as $prod){
            $sql = "INSERT INTO vendas_produtos SET id_venda = ?, id_produto = ?, quantidade = ?";
            $sql = $this->conn->prepare($sql);
            $sql->execute(array($id_venda, $prod, $qtds[$prod]));
        }

        unset($_SESSION['carrinho']);
    }
}