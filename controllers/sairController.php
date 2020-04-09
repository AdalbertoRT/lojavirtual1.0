<?php
class sairController extends controller{

    public function index(){
        if(isset($_SESSION['logado'])){
            unset($_SESSION['logado']);
        }
        header("Location: ".BASE_URL);
    }
}