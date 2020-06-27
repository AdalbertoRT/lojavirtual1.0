<?php
        require './libs/vendor/autoload.php';

        // Configura credenciais
        MercadoPago\SDK::setAccessToken('ENV_ACCESS_TOKEN');
    
        // Cria um objeto de preferência
        $preference = new MercadoPago\Preference();
    
        // Cria um item na preferência
        $item = new MercadoPago\Item();
        $item->title = 'Meu produto';
        $item->quantity = 1;
        $item->unit_price = 75.56;
        $preference->items = array($item);
        $preference->save();
        
        echo "<form action='".BASE_URL."' method='POST'>
            <script
            src='https://www.mercadopago.com.br/integrations/v1/web-payment-checkout.js'
            data-preference-id='$preference->id'>
            </script>
        </form>";
        
       