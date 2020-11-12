<template>
    <div>
        
        <div v-for="semana in semanas" v-bind:key="semana.id">
            <Semana :data="JSON.stringify(semana)" :token="token"></Semana>
        </div>
        <div class="row align-middle" style="backgroung-color: #f0e9c9" @click="addSemana">
            <i style="margin: auto;" class="fa fa-plus" aria-hidden="true"></i>
        </div>
    </div>
</template>

<script>
export default {
    props: ['packId'],

    data() {
        return {
            token: '',
            semanas: [],
        }
    },

    created() {
        this.fetchSemanas()
    },

    methods: {
        async fetchSemanas() {
            let vm = this;

            await fetch('/get-personal/token')
            .then(res => res.json())
            .then(res => { 
                this.token = res.data;
                //console.log(res.data); 
            })
            .catch(err => console.log(err));

            fetch(`api/semana/${vm.packId}` , 
            { headers: {
                "Authorization" : `Bearer ${this.token}` ,
                },
                method: 'GET', 
            }).then(res => res.json()).then(res => {

                this.semanas = res.data;

            }).catch(err => console.log(err));
        },

        async addSemana() {
            let vm = this;

            const formData = new FormData();
            

            formData.append('pack_id', vm.packId);

            fetch('api/semana' , 
            { headers: {
                "Authorization" : `Bearer ${this.token}` ,
                },
                body: formData,
                method: 'POST', 
            }).then(res => res.json()).then(res => {

            
                this.fetchSemanas();


            }).catch(err => console.log(err));
    },
    },

    
}
</script>