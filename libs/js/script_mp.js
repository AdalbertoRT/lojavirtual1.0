(function(win, doc){
    "use strict";

    // Public Key
    window.Mercadopago.setPublishableKey("TEST-bd445818-45ca-4143-873a-e09f319c85de");

    // Tipos de documento
    window.Mercadopago.getIdentificationTypes();

    // Card bin
    (document.getElementById('cardNumber')) ? document.getElementById('cardNumber').addEventListener('keyup', guessPaymentMethod) : false;
    (document.getElementById('cardNumber')) ? document.getElementById('cardNumber').addEventListener('change', guessPaymentMethod) : false;

    function guessPaymentMethod(event) {
        let cardnumber = document.getElementById("cardNumber").value;

        if (cardnumber.length >= 6) {
            let bin = cardnumber.substring(0,6);
            window.Mercadopago.getPaymentMethod({
                "bin": bin
            }, setPaymentMethod);
        }
    };

    function setPaymentMethod(status, response) {
        if (status == 200) {
            let paymentMethodId = response[0].id;
            let element = document.getElementById('payment_method_id');
            element.value = paymentMethodId;
            document.querySelector("#brand_card").innerHTML = "<img src='"+response[0].thumbnail+"' alt='Bandeira do Cartão'/>";
            document.querySelector("#brand_card").style.display = "flex";
            getInstallments();
        } else {
            alert(`payment method info error: ${response}`);
        }
    }

    //  Qtd Parcelas
    function getInstallments(){
        window.Mercadopago.getInstallments({
            "payment_method_id": document.getElementById('payment_method_id').value,
            "amount": parseFloat(document.getElementById('transaction_amount').value)
    
        }, function (status, response) {
            if (status == 200) {
                document.getElementById('installments').options.length = 0;
                document.querySelector('.info-parcelas').innerHTML = "";

                response[0].payer_costs.forEach( installment => {
                    let opt = document.createElement('option');
                    opt.text = installment.recommended_message;
                    opt.value = installment.installments;
                    let linha = document.createElement('p');
                    let string = installment.recommended_message.split("(");
                    let parcela = (installment.installments == 1) ? string[0].replace("parcela", "x") : string[0].replace("parcelas", "x");
                    let valor = string[1].replace(/([()]*)/g, '');
                    if(installment.installments == 1){
                        valor = string[1].replace(/([()]*)/g, '') + " <small>(sem juros)</small>";
                    }
                    linha.innerHTML = "<span class='py-1'>"+parcela+"</span><span class='py-1'>"+valor+"</span>";
                    document.getElementById('installments').appendChild(opt);
                    document.querySelector('.info-parcelas').appendChild(linha);
                });
            } else {
                alert(`installments method info error: ${response}`);
            }
        });
    }

    // Verificar parcelas no link do carrinho
    if(doc.querySelector(".verParcelas")){
        doc.querySelector(".verParcelas").addEventListener('click', () => {
            window.Mercadopago.getInstallments({
                "payment_method_id": 'master',
                "amount": parseFloat(document.getElementById('valor_cartao').innerText.replace(",","."))
        
            }, function (status, response) {
                if (status == 200) {
                    document.querySelector('.info-parcelas').innerHTML = "";
    
                    response[0].payer_costs.forEach( installment => {
                        let linha = document.createElement('tr');
                        let string = installment.recommended_message.split("(");
                        let parcela = (installment.installments == 1) ? string[0].replace("parcela", "x") : string[0].replace("parcelas", "x");
                        let valor = string[1].replace(/([()]*)/g, '');
                        if(installment.installments == 1){
                            valor = string[1].replace(/([()]*)/g, '') + " <small>(sem juros)</small>";
                        }
                        linha.innerHTML = "<td class='py-1'>"+parcela+"</td><td class='py-1'>"+valor+"</td>";
                        document.querySelector('.info-parcelas').appendChild(linha);
                    });
                } else {
                    alert(`installments method info error: ${response}`);
                }
            });
        });
    }
    
    
    // CRIAR TOKEN DA TRANSAÇÃO
    // doSubmit = false;
    // doc.querySelector('#pay').addEventListener('submit', doPay);

    function doPay(event){
        event.preventDefault();
            window.Mercadopago.createToken(event.target, sdkResponseHandler);
    };

    function sdkResponseHandler(status, response) {
        if (status == 200 || status == 201) {
            var form = doc.querySelector('#pay');
            var card = doc.createElement('input');
            card.setAttribute('name', 'token');
            card.setAttribute('type', 'hidden');
            card.setAttribute('value', response.id);
            form.appendChild(card);
            form.submit();
        }else{
            alert("Verifique os dados preenchidos! ");
        }
    };
    if(doc.querySelector("#pay")){
        let formPay = doc.querySelector("#pay");
        formPay.addEventListener('submit', doPay, false);
    }

})(window, document);
