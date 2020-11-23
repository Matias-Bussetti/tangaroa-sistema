<template>
    <div>
        <div class="col-12">
            <div style="display: flex;">

                <img class="col-12" :src="data.image_horizontal" alt="">

                <h1 class="title">{{data.name}}</h1>

                <a v-if="admin" :href="'/admin/settings/edit-pack/' + data.id"><i id="editIcon" style="margin: auto;"
                        class="fa fa-pencil" aria-hidden="true"></i></a>

            </div>

            <div v-if="admin" class="row align-middle" style="backgroung-color: #f0e9c9" @click="addSemana">
                <i style="margin: auto;" class="fa fa-plus" aria-hidden="true"></i>
            </div>

            <slot></slot>

            <div v-for="semana in semanas" :key="semana.id">
                <Semanabanner :data="semana" :token="token" :admin="admin" ></Semanabanner>
            </div>
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