{/* <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> */}
// let erro404 = new Vue({
//     el: "#erro404",
//     data: {
//         timer: 5
//     },
//     methods: {
//         gohome: function(){
            
//             setTimeout(() => {
//                 this.timer -= 1;
//                 if(this.timer == 0){
//                    document.location.href = location.origin + "/lojavirtual1.0";
//                 }                
//             }, 1000);
//         }
//     }

// });

// let finalizar = new Vue({
//     el:"#finalizar",
//     data:{
//         total: parseInt(document.querySelector(".preco").innerText)
//     },
//     methods:{
//         totalizar: function (){
//             let u = parseInt(document.querySelector(".preco").innerText);
//             let q = parseInt(document.querySelector(".qtd").innerText);
//             let t = q * u;
//             this.total = t;
            
//         }
//     }
// });

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
        }
    });
});
$("#numero").focusout(function(){
    document.querySelector(".balaoNumero").style.display = "none";
});

// document.querySelector('#pagar').addEventListener('click', (e) => e.preventDefault());

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
