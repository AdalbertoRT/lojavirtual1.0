<?php
class Cadastro extends model{

    public function cadastrar($nome, $email, $senha, $telefone = ""){
        if(!empty($nome) && !empty($email) && !empty($senha)){
            $sql = "INSERT INTO usuarios (nome, email, senha, telefone) VALUES (:nome, :email, :senha, :telefone)";
            $sql = $this->conn->prepare($sql);
            $sql->execute(array(":nome" => $nome, ":email" => $email, ":senha" => $senha, "telefone" => $telefone));
        }
    }
}