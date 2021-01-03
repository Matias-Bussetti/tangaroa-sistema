<template>
    <div>

        <div class="delimitador">

            <h1 class="ml-1">{{clase.name}}</h1>
            <p>{{clase.description}}</p>
            <div class="contenedor">
                <iframe :src="clase.link" class="video video-iframe" frameborder="0" allow="autoplay; fullscreen"
                    allowfullscreen></iframe>
            </div>
    
            <br>
    
            <div v-if="!admin" class="done-button-container">
                <a class="btn done-button" style="background: #FCE83C;" @click="doneClase" href="#" role="button">Hecho</a>
            </div>


        </div>

    <p>{{response}}</p>
    </div>
</template>

<script>

export default {

    props: ['data', 'userId', 'admin'],

    data() {
        return {
            clase: {
                id: '',
                name: '',
                description: '',
                link: '',
            },
            response: '',
        }
    },

    created() {
        this.clase = this.data;
    },

    methods: {

        async doneClase() {

                await fetch(`/api/clase/${this.clase.id}/user/${this.userId}`, {
                    headers: {
                        "Authorization": `Bearer ${this.token}`
                    }
                }).then(res => res.json()).then(res => {

                    console.log(res.data);
                    
                    window.location.href = `/my-pack/${res.data.name}/tag/${res.data.id}`;

                }).catch(err => console.log(err));
        }
    },
}
</script>
