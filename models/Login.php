<?php
class Login extends model{

    public function logar($email, $senha){
    
        if(!empty($email) && !empty($senha)){
            $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
            $sql = $this->conn->prepare($sql);
            $sql->execute(array(':email' => $email, ':senha' => $senha));
            $usuario = array();
            if($sql->rowCount() > 0){
                $usuario = $sql->fetch(); 
            }
            return $usuario;
        }else{
            header("Location: ".BASE_URL."login");
        }
    }

    public function existeEmail($email){
        $sql = "SELECT email FROM usuarios WHERE email = :email";
        $sql = $this->conn->prepare($sql);
        $sql->execute(array(":email" => $email));
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function checkCredentials($email, $senha){
        $sql = "SELECT id FROM usuarios WHERE email = :email AND senha = :senha";
        $sql = $this->conn->prepare($sql);
        $sql->execute(array(":email" => $email, ":senha" => $senha));
        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
}