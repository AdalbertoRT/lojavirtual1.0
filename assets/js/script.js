// VARIÁVEIS
let campoCep = (document.querySelector(".cepProd")) ? document.querySelector(".cepProd") : '';

// --------------------------- ViaCEP --------------------------- //
$("#cep").focusout(function(){
    document.querySelector(".balaoCep").style.display = "none";
    document.querySelector(".balaoNumero").style.display = "block";
    //Início do Comando AJAX
    $.ajax({
        //O campo URL diz o caminho de onde virá os dados
        //É importante concatenar o valor digitado no CEP
        url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
        //Aqui você deve preencher o tipo de dados que será lido,
        //no caso, estamos lendo JSON.
        dataType: 'json',
        //SUCESS é referente a função que será executada caso
        //ele consiga ler a fonte de dados com sucesso.
        //O parâmetro dentro da função se refere ao nome da variável
        //que você vai dar para ler esse objeto.
        success: function(resposta){
            //Agora basta definir os valores que você deseja preencher
            //automaticamente nos campos acima.
            $("#logradouro").val(resposta.logradouro);
            $("#complemento").val(resposta.complemento);
            $("#bairro").val(resposta.bairro);
            $("#cidade").val(resposta.localidade);
            $("#uf").val(resposta.uf);
            //Vamos incluir para que o Número seja focado automaticamente
            //melhorando a experiência do usuário
            $("#numero").focus();
        },
    });
});
$("#numero").focusout(function(){
    document.querySelector(".balaoNumero").style.display = "none";
});

// CALCULAR FRETE COM O CEP
$(document).ready(function(){
    if(campoCep){
        if(campoCep.value != ""){
            frete();
         }
    }
});

// CLICAR BOTÃO OK DO CEP
if(document.querySelector(".cepOk")){
    document.querySelector(".cepOk").addEventListener('click', () => {
        inLoad();
        frete();
        setTimeout(() => {
            item.parentNode.removeChild(item);
            
        }, 2000);
        setTimeout(() => {
            location.reload();
        }, 500);
    });
}
// FUNCAO DE CALCULO DO FRETE
function frete(){
    let cepDestino = $(".cepProd").val();
    cepDestino = cepDestino.replace("-", "");
    
    $.ajax({
        
        url: 'https://viacep.com.br/ws/'+ cepDestino +'/json/unicode/',
        dataType: 'json',
        // beforeSend: function(){
        //     inLoad();
        // },
        success: function(resposta){
            if(resposta.erro){
                alert("CEP Inválido!");
                $(".cepProd").val("");
                $(".cepProd").focus();
            }else{
                $(".infoFrete").html("");
                $(".infoFrete").html("<small>Entrega para " + resposta.localidade + "/" + resposta.uf + "</small>");
                $(".fretePara").show(500);
                $(".map_marker").show(500);
                $(".fretePara").css("min-height", "80px");
                $( ".infoFrete" ).show(500);
                $( ".infoPrazo" ).css('opacity', 1);
                $(".inputFrete").addClass("desaparecer");
                $(".alterarCep").show(500);
                let href = window.location.href;
                let id = ($("#nomeProd")) ? $("#nomeProd").attr("data-id") : "";
                var retorno = href.replace(document.location.pathname, "/lojavirtual1.0/correios/fretePrazo/" + id + "/" + cepDestino + "/04014/04510");
                let item = document.querySelector(".loading");
                fetch(retorno);
            }
            
        },
        error: function(){
            alert("CEP Inválido!");
            $(".cepProd").val("");
            $(".cepProd").focus();
        }
    });

    // let href = window.location.href;
    // if(href.search("produto") > -1){
    //     let id = $("#nomeProd").attr("data-id");
    //     // var sedex = href.replace(document.location.pathname, "/lojavirtual1.0/correios/fretePrazo/" + cepDestino + "/04014");
    //     // var pac = href.replace(document.location.pathname, "/lojavirtual1.0/correios/fretePrazo/" + cepDestino + "/04510");
    //     // var sedex12 = href.replace(document.location.pathname, "/lojavirtual1.0/correios/fretePrazo/" + cepDestino + "/04782");
    //     // var sedex10 = href.replace(document.location.pathname, "/lojavirtual1.0/correios/fretePrazo/" + cepDestino + "/04790");
    //     // var sedexhj = href.replace(document.location.pathname, "/lojavirtual1.0/correios/fretePrazo/" + cepDestino + "/04804");
    //     var frete = href.replace(document.location.pathname, "/lojavirtual1.0/correios/fretePrazoProduto/" + id + "/" + cepDestino + "/04014/04510");
    // }else if(href.search("carrinho") > -1){
    //     // var sedex = href.replace(document.location.pathname, "/lojavirtual1.0/correios/fretePrazo/" + cepDestino + "/04014");
    //     // var pac = href.replace(document.location.pathname, "/lojavirtual1.0/correios/fretePrazo/" + cepDestino + "/04510");
    //     // var sedex12 = href.replace(document.location.pathname, "/lojavirtual1.0/correios/fretePrazo/" + cepDestino + "/04782");
    //     // var sedex10 = href.replace(document.location.pathname, "/lojavirtual1.0/correios/fretePrazo/" + cepDestino + "/04790");
    //     // var sedexhj = href.replace(document.location.pathname, "/lojavirtual1.0/correios/fretePrazo/" + cepDestino + "/04804");
    //     var frete = href.replace(document.location.pathname, "/lojavirtual1.0/correios/fretePrazoCarrinho/" + cepDestino + "/04014/04510");
    // }

    // $.ajax({
        
    //     url: frete,
    //     // beforeSend: function(){
    //     //     inLoad();
    //     // },
    //     success: function (){
    //         var item = document.querySelector(".loading");
    //         item.parentNode.removeChild(item);
    //     }
    //     // method: 'post',
    //     // dataType: 'json',
    //     // success: function(resposta){
    //     //     // alert(resposta);
    //     //     $(".infoPrazo").html("");
    //     //     $(".infoPrazo").html("<small>" + resposta + "</small>");
    //     //     $('.freteTipo').html('Frete (' + $('.freteRadio:checked').attr('id').toUpperCase() + ")");
    //     //     $('.freteTotal').html('R$ ' + $('.freteRadio:checked').val());
    //     // }
    // });

};
if(document.querySelector(".alterarCep")){
    document.querySelector(".alterarCep").addEventListener("click", function(){
        this.style.display = "none";
        document.querySelector(".inputFrete").classList.remove("desaparecer");
        $(".fretePara").hide();
        $(".map_marker").hide();
        $(".fretePara").css("min-height", "0");
        $( ".infoFrete" ).hide();
        $( ".infoPrazo" ).css('opacity', 0);
        $(".alterarCep").hide();
        $(".cepProd").val("").focus();
    });
}

// SELECIONAR TIPO DE FRETE
document.querySelectorAll(".freteRadio").forEach(element => {
    element.addEventListener('click', () => {
        let url = location.href.replace(document.location.pathname, "/lojavirtual1.0/correios/freteEscolhido/" + element.value);
        $.ajax({
            url: url,
            success: function(){
                document.querySelector('.freteTotal').innerHTML = element.value;
                location.reload();
            }
        });
    });
});

// -------------- Aumentar/Diminuir QTD Carrinho ---------------- //
let itemsCart = document.querySelectorAll('.itemsCart');
itemsCart.forEach( (item) => {
    let qtd = parseInt(item.querySelector('.qtd').innerHTML);
    let preco = parseFloat(item.querySelector('.preco').innerHTML);
    item.querySelector('.qtdMenos').addEventListener('click', () => {
        let id = item.getAttribute('data-id');
        if(qtd > 1){
           let href = window.location.href.replace(/carrinho/g, "carrinho/remove/" + id);
           window.location.href = href;
            // qtd--;
        }else{
            let r = confirm("Deseja excluir este item do carrinho?");
            if(r == true){
                let href = window.location.href.replace(/carrinho/g, "carrinho/excluirItem/" + id);
                window.location.href = href; 
            }
        }
        // let novopreco = preco * qtd;
        // item.querySelector('.qtd').innerHTML = qtd;
        // item.querySelector('.preco').innerHTML = novopreco;
        // updateCarrinho();
    } );
    item.querySelector('.qtdMais').addEventListener('click', () => {
        let id = item.getAttribute('data-id');
        let href = window.location.href.replace(/carrinho/g, "carrinho/add/" + id);
        window.location.href = href;
                
        // let estoque = item.querySelector('.qtd').getAttribute('data-estoque');
        // if(qtd < estoque){
        //     qtd++;
        // }
        // let novopreco = preco * qtd;
        // item.querySelector('.qtd').innerHTML = qtd;
        // item.querySelector('.preco').innerHTML = novopreco;
        // updateCarrinho();
    } );
    item.querySelector('.qtd').addEventListener('change', ()=>{
        updateCarrinho();
    })
} );

// ----------------- ADICIONA DESCONTOS ------------------- //
function descontos(){
    let codigo = document.querySelector(".inputDesconto").value;
    if(codigo != ''){
        let url = location.href.replace(document.location.pathname, "/lojavirtual1.0/carrinho/descontos/" + addslashes(codigo));
        $.ajax({
            url: url,
            success: function(resposta){
                if(resposta > 0){
                    location.reload();
                }else{
                    alert("Código de desconto inválido!");
                    document.querySelector(".inputDesconto").value = '';
                    document.querySelector(".inputDesconto").focus();
                }  
            }
        });
    }else{
        document.querySelector(".inputDesconto").value = '';
        document.querySelector(".inputDesconto").focus();
    }
    
}

// ----------------- FORMAS DE PAGAMENTO ------------------- //
if(document.querySelector(".tab")){
    let tabs = document.querySelectorAll(".tab");
    tabs.forEach((item)=> {
        item.addEventListener('click', function(){
            tabs.forEach((el) =>  {
                el.querySelector("i").classList.remove("selected");            
            });
            item.querySelector("i").classList.add("selected");
        });
    });
}

// ----------------- Atualiza Carrinho ------------------- //
function updateCarrinho(){
    let precos = 0;
    itemsCart.forEach((item)=>{
        precos += parseFloat(item.querySelector('.preco').innerHTML);
    });
    document.querySelector('.subtotal').innerHTML = precos;
}

// ----------------- Finalizar Compra (Carrinho) ------------------- //
// document.querySelector('.finalizar').addEventListener('click', (e) => {
//     e.preventDefault();

//     let qtd = '';
//     itemsCart.forEach((item)=>{
//         qtd += item.querySelector('.qtd').innerHTML + '@';
//     })
//     let href = window.location.href.replace(/carrinho/g, "finalizar/index/" + qtd); 
//     console.log(href);
// });
 
//VISUALIZAÇÃO DE PARCELAS
// function parcelas(){
//     let url = location.href.replace(document.location.pathname, "/lojavirtual1.0/carrinho/parcelamentos/");
//     $.ajax({
//         url: url
//     });
// }

// ----------------- Desabilitar tecla Enter ------------------- //
$(document).ready(function () {
    $('input').keypress(function (e) {
         var code = null;
         code = (e.keyCode ? e.keyCode : e.which);               
         return (code == 13) ? false : true;
    });
 });

// document.querySelector("#pagar").addEventListener("click", (e) => {
//     e.preventDefault();
// });

// TELA DE LOADING
function inLoad(){
    let loading = document.createElement('DIV');
    let twist = document.createElement('DIV');
    loading.classList.add("loading");
    twist.classList.add("twist");
    document.body.appendChild(loading);
    document.querySelector(".loading").appendChild(twist);
}

// FUNÇÃO ADDSLASHES
function addslashes(string) {
    return string.replace(/\\/g, '\\\\').
        replace(/\u0008/g, '\\b').
        replace(/\t/g, '\\t').
        replace(/\n/g, '\\n').
        replace(/\f/g, '\\f').
        replace(/\r/g, '\\r').
        replace(/'/g, '\\\'').
        replace(/"/g, '\\"');
}

// FINALIZAR COMPRA
if(document.querySelector(".finalizar")){
    document.querySelector(".finalizar").addEventListener("click", () => {
        if(!document.querySelector(".finalizar").classList.contains("btn-disabled")){
            let cep = document.querySelector(".cepProd").value;
            if(cep == '' || cep.length != 8 ){
                alert("Digite o CEP de entrega!");
                document.querySelector(".cepProd").focus();
            }
        }
    });
}

