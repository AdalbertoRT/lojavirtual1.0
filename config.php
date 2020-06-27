<?php 
require "environment.php"; 

// DADOS SOBRE A EMPRESA
define("CEP_ORIGEM", "15041250");
// DADOS DO SITE
if (ENVIRONMENT == 'development') {
    define('BASE_URL', 'http://'.$_SERVER['SERVER_NAME'].'/lojavirtual1.0/');
    // CREDENCIAIS MP
    define('ENV_PUBLIC_KEY', 'TEST-bd445818-45ca-4143-873a-e09f319c85de');
    define('ENV_ACCESS_TOKEN', 'TEST-4026562650908705-060602-6f10dde48ec6b281e6e860ff8e95fcc0-57378360');
    // 
    $config = array(
        'dbname' => 'lojav1',
        'dbhost' => 'localhost',
        'dbuser' => 'root',
        'dbpass' => '',
        'charset' => array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
    
}else{
    define('BASE_URL', 'http://www.lojavirtual1.0.com.br/');
    // CREDENCIAIS MP
    define('ENV_PUBLIC_KEY', 'APP_USR-cb310cd2-dbb4-4f5b-8803-0174b26efd03');
    define('ENV_ACCESS_TOKEN', 'APP_USR-4026562650908705-060602-05b379ef3b1fc2b453a73a8683991ce3-57378360');
    // 
    $config = array(
        'dbname' => 'lojav1',
        'dbhost' => 'localhost',
        'dbuser' => 'root',
        'dbpass' => '',
        'charset' => array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
}

global $conn;

try {
    $conn = new PDO('mysql:dbname='.$config['dbname'].';host='.$config['dbhost'], $config['dbuser'], $config['dbpass'], $config['charset']);
} catch (PDOException $e) {
    echo "ERRO: ".$e->getMessage();
}