<?php
class controller {

    public function loadView($viewName, $viewData = array()) {
        extract($viewData);
        require "views/".$viewName.".php";
    }
    
    public function loadTemplate($viewName, $viewData = array()) {
        extract($viewData);
        $categorias = new Categoria();
        $categorias = $categorias->listar();
        require "views/template.php";
    }

    public function loadViewInTemplate($viewName, $viewData = array()) {
        extract($viewData);
        require "views/".$viewName.".php";
    }
}
