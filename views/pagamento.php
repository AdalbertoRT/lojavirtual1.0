<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Checkout Transparente - Mercado Pago</title>
</head>
<body>
<section class="container d-flex flex-column justify-content-center align-items-center bg-secondary">
    <h3 class="text-light">Dados para Pagamento</h3>
    <form action="controllers/paymentController.php" method="post" id="pay" name="pay" class="w-50 m-1 p-2 bg-light border rounded">
        <fieldset>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="description">Descrição</label>                        
                    <input type="text" name="description" id="description" value="Ítem selecionado" class="form-control"/>
                </div>
                <div class="form-group col-md-4">
                    <label for="transaction_amount">Valor a pagar</label>                        
                    <input name="transaction_amount" id="transaction_amount" value="100" class="form-control"/>
                </div>
            </div>                    
            <div class="form-row">
                <div class="form-group col-8">
                    <label for="cardNumber">Número do cartão</label>
                    <div class="d-flex">
                        <input type="text" id="cardNumber" data-checkout="cardNumber" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off class="form-control"/>
                        <div class="input-group-prepend p-1 border rounded shadow position-absolute align-self-center" id="brand_card" style="display: none; right:10px;"></div>
                    </div>
                </div>
                <div class="form-group col-4 align-items-center">
                    <label for="cardExpirationMonth">Data de Vencimento</label><br>
                    <div class="d-flex align-items-center">
                        <input type="text" id="cardExpirationMonth" value="11" data-checkout="cardExpirationMonth" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off class="form-control text-center" placeholder="Mês"/>
                        <span class="mx-1">/</span>
                        <input type="text" id="cardExpirationYear" value="2025" data-checkout="cardExpirationYear" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off class="form-control text-center" placeholder="Ano"/>
                    </div>
                </div>             
            </div>
            <div class="form-row">
                <div class="form-group col-9">
                    <label for="cardholderName">Nome (como esta no cartão)</label>
                    <input type="text" id="cardholderName" data-checkout="cardholderName" placeholder="4170 0688 1010 8020" class="form-control"/>
                </div>
                <div class="form-group col-3">
                    <label for="securityCode" title="Código de Verificação de Cartão">CVC</label>
                    <input type="text" id="securityCode" value="123" data-checkout="securityCode" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off class="form-control" title="Código de Verificação de Cartão"/>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-4">
                    <label for="docType">Documento</label>
                    <select id="docType" data-checkout="docType" class="form-control"></select>
                </div>
                <div class="form-group col-8">
                    <label for="docNumber">Número do documento</label>
                    <input type="text" id="docNumber" value="42916180850" data-checkout="docNumber" class="form-control"/>
                </div>
            </div>
    
            <div class="form-group">
                <label for="installments">Parcelas</label>
                <select id="installments" class="form-control" name="installments" class="form-control"></select>
            </div>
        
            <p class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="test@test.com" class="form-control"/>
            </p>
            <input type="hidden" name="payment_method_id" id="payment_method_id"/>
            <input type="submit" value="Pagar" class="btn btn-success"/>
        </fieldset>
    </form>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Todas as Formas de Pagamento
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header py-1 bg-secondary text-light">
            <h5 class="modal-title" id="exampleModalLabel">Formas de Pagamento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-light">&times;</span>
            </button>
        </div>
        <div class="modal-body p-0">
            <table class="table">
                <thead >
                    <th class="py-1">Parcelas</th>
                    <th class="py-1">Valor</th>
                </thead>
                <tbody class="info-parcelas p-1">
                
                </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>
</section>

    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
    <script src="libs/js/script_mp.js"></script>
</body>
</html>