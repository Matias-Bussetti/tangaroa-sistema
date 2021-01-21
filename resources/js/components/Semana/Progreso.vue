<template>
    <div>
        <p>Progreso: {{this.progreso}}%</p>

        <div  v-for="semana in semanas" v-bind:key="semana.id" style="border: 1px solid black"  :style="{'border-color': semana.semana.color}">
            <h3 :style="{background: semana.semana.color}">{{semana.semana.name}}</h3>
            <div style="padding: 5px ">

            <div v-for="clase in semana.semana.clases" v-bind:key="clase.id">
                <p style="line-height: 0.5em;">
                    <i class="far" :class=" clase.done == 'true' ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' "></i>
                    {{clase.name}}
                </p>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['id', 'user-id', 'token'],
    data() {
        return {
                progreso: '',
                semanas: [{
                    semana: {
                        id: '',
                        name: '',
                        color: '',
                        clases: {
                            id: '',
                            name: '',
                            done: false,
                        }
                    }
                }],
        }
    },

    created() {
        this.fetchLink();
    },

    mounted() {

    },

    methods: {
        async fetchLink() {

            await fetch(`/api/progreso/${this.id}/${this.userId}`, {
                headers: {
                    "Authorization": `Bearer ${this.token}`,
                },
                method: 'GET',
            }).then(res => res.json()).then(res => {

                this.progreso = res.data[0].progreso;
                this.semanas = res.data[1].semanas;

                console.log(this.progreso);
                console.log(this.semanas);

            }).catch(err => {
                console.log(err);
            });

        },
    },
}
</script>