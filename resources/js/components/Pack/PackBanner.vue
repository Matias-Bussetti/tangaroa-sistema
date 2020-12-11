<template>
    <div>
        <div class="banner" :style="`background-image: url('${data.image_horizontal}');`">

            <div class="title-container">
                <h1>{{data.name}}</h1>
            </div>

            <a class="edit-icon" v-if="admin" :href="'/admin/settings/edit-pack/' + data.id">
                <i id="editIcon" style="margin: auto;" class="fa fa-pencil" aria-hidden="true"></i>
            </a>

        </div>

        

        <slot></slot>

        <div v-for="semana in semanas" :key="semana.id">
            <Semanabanner :data="semana" :token="token" :admin="admin" :count="0"></Semanabanner>
        </div>

        <div v-if="admin" class="add-semana" @click="addSemana">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </div>
        
    </div>
</template>

<script>
export default {

    props: ['data', 'token', 'admin'],

    data() {
        return {
            semanas: [],
        }
    },

    methods: {

        async fetchSemanas() {

            fetch(`/api/semana/${this.data.id}`, {
                headers: {
                    "Authorization": `Bearer ${this.token}`,
                },
                method: 'GET',
            }).then(res => res.json()).then(res => {

                this.semanas = res.data;
                console.log(this.semanas);
            }).catch(err => console.log(err));
        },

        async addSemana() {

            const formData = new FormData();

            formData.append('pack_id', this.data.id);

            fetch('/api/semana', {
                headers: {
                    "Authorization": `Bearer ${this.token}`,
                },
                body: formData,
                method: 'POST',
            }).then(res => res.json()).then(res => {

                console.log(res.data);
                this.semanas.push(res.data)
                //this.fetchSemanas();

            }).catch(err => console.log(err));
        },

    },
}
</script>

<style scoped>
    .title{
        position: absolute;
        left: 46%;
        margin-top: 3%;
        color: white;
        mix-blend-mode: difference;
    }
</style>