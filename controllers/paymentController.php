<?php  
    require_once '../libs/vendor/autoload.php';

    MercadoPago\SDK::setAccessToken("TEST-4026562650908705-060602-6f10dde48ec6b281e6e860ff8e95fcc0-57378360");

    $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
    $valor = filter_input(INPUT_POST,'transaction_amount',FILTER_DEFAULT);
    $token = filter_input(INPUT_POST,'token',FILTER_DEFAULT);
    $descricao = filter_input(INPUT_POST,'description',FILTER_DEFAULT);
    $cardNumber = filter_input(INPUT_POST,'cardNumber',FILTER_DEFAULT);
    $securityCode = filter_input(INPUT_POST,'securityCode',FILTER_DEFAULT);
    $cardExpirationMonth = filter_input(INPUT_POST,'cardExpirationMonth',FILTER_DEFAULT);
    $cardExpirationYear = filter_input(INPUT_POST,'cardExpirationYear',FILTER_DEFAULT);
    $cardholderName = filter_input(INPUT_POST,'cardholderName',FILTER_DEFAULT);
    $docType = filter_input(INPUT_POST,'docType',FILTER_DEFAULT);
    $docNumber = filter_input(INPUT_POST,'docNumber',FILTER_DEFAULT);
    $parcelas = filter_input(INPUT_POST,'installments',FILTER_DEFAULT);
    $tipoPagamento = filter_input(INPUT_POST,'payment_method_id',FILTER_DEFAULT);
    $pagador = array(
        'email' => $email
    );

    $payment = new MercadoPago\Payment();
    $payment->transaction_amount = $valor;
    $payment->token = $token;
    $payment->description = $descricao;
    $payment->installments = $parcelas;
    $payment->payment_method_id = $tipoPagamento;
    $payment->payer = $pagador;

$payment->save();

$payment_methods = MercadoPago\SDK::get("/v1/payment_methods");
print_r($payment_methods);

echo "<pre>".print_r($payment)."</pre>";


echo "STATUS: ".$payment->status."<br/>";
echo "DETALHE: ".$payment->status_detail."<br/>";
echo "BANDEIRA: ".$payment->payment_method_id."<br/>";
echo "TIPO DE CARTÃO: ".$payment->payment_type_id."<br/>";

