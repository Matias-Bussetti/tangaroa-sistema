<template>
    <div>
        
        <div v-for="semana in semanas" v-bind:key="semana.id">
             <Semana :data="JSON.stringify(semana)" :token="token"></Semana> 
        </div>
        <div class="row align-middle" style="backgroung-color: #f0e9c9" @click="addSemana">
            <i style="margin: auto;" class="fa fa-plus" aria-hidden="true"></i>
        </div>-
    </div>
</template>

<script>
export default {
    props: ['packData', 'semanaData', 'token'],

    data() {
        return {
            pack: {
                id: '',
                name: '',
                description: '',
                image_horizontal: '',
            },
            semanas: [],
        }
    },

    created() {

        this.pack.id = this.packData.id;
        this.pack.name = this.packData.name;
        this.pack.description = this.packData.description;
        this.pack.image_horizontal = this.packData.image_horizontal;

        this.semanas = this.semanaData;
        //console.log(this.semanaData);
        //console.log(JSON.parse(this.packData.semanas));
        //this.semana = JSON.parse(this.packData);
    },

    methods: {
        async fetchSemanas() {

            fetch(`/api/semana/${this.pack.id}`, {
                headers: {
                    "Authorization": `Bearer ${this.token}`,
                },
                method: 'GET',
            }).then(res => res.json()).then(res => {

                this.semanas = res.data;

            }).catch(err => console.log(err));
        },

        async addSemana() {

            const formData = new FormData();

            formData.append('pack_id', this.pack.id);

            fetch('/api/semana', {
                headers: {
                    "Authorization": `Bearer ${this.token}`,
                },
                body: formData,
                method: 'POST',
            }).then(res => res.json()).then(res => {


                this.fetchSemanas();


            }).catch(err => console.log(err));
        },

        async fetchClases() {

            fetch(`/api/clases/${this.semana.id}`, {
                headers: {
                    "Authorization": `Bearer ${this.token}`,
                },
                method: 'GET',
            }).then(res => res.json()).then(res => {

                this.clases = res.data;
                console.log(this.clases.length)

            }).catch(err => console.log(err));
        },
        
    },


}
</script>