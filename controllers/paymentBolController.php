<?php

require_once '../libs/vendor/autoload.php';
require_once '../config.php';

MercadoPago\SDK::setAccessToken(SAND_TOKEN);

$valor = 100;
$desconto = $valor * -(5/100);
date_default_timezone_set('America/Sao_Paulo');

$payment = new MercadoPago\Payment();
// $prazo = date('Y-m-d\TH:m:s.zP', strtotime('+5 days'));
// $payment->date_of_expiration = $prazo;
$payment->transaction_amount = $valor + $desconto;
$payment->description = "Título do produto";
$payment->payment_method_id = "bolbradesco";
$payment->payer = array(
    "email" => "test@test.com",
    "first_name" => "Test",
    "last_name" => "User",
    "identification" => array(
        "type" => "CPF",
        "number" => "19119119100"
    ),
    "address"=>  array(
        "zip_code" => "06233200",
        "street_name" => "Av. das Nações Unidas",
        "street_number" => "3003",
        "neighborhood" => "Bonfim",
        "city" => "Osasco",
        "federal_unit" => "SP"
    )
);

$payment->save();