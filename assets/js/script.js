<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
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
