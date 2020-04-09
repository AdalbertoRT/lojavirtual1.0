{/* <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> */}
let erro404 = new Vue({
    el: "#erro404",
    data: {
        timer: 5
    },
    methods: {
        gohome: function(){
            
            setTimeout(() => {
                this.timer -= 1;
                if(this.timer == 0){
                   document.location.href = location.origin + "/lojavirtual1.0";
                }                
            }, 1000);
        }
    }

});

let finalizar = new Vue({
    el:"#finalizar",
    data:{
        total: parseInt(document.querySelector(".preco").innerText)
    },
    methods:{
        totalizar: function (){
            let u = parseInt(document.querySelector(".preco").innerText);
            let q = parseInt(document.querySelector(".qtd").value);
            let t = q * u;
            this.total = t;
            
        }
    }
});

// --------------------------- ViaCEP --------------------------- //
$("#cep").focusout(function(){
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

// ----------------- Desabilitar tecla Enter ------------------- //
$(document).ready(function () {
    $('input').keypress(function (e) {
         var code = null;
         code = (e.keyCode ? e.keyCode : e.which);                
         return (code == 13) ? false : true;
    });
 });
