<template>
    <div>

        <div class="banner" :style="`background-image: url('${pack.image_horizontal}');`">

            <div class="title-container">
                <h1>{{pack.name}}</h1>
            </div>

            <a class="edit-icon" v-if="admin" :href="'/admin/settings/edit-pack/' + pack.id">
                <i id="editIcon" style="margin: auto;" class="fa fa-pencil" aria-hidden="true"></i>
            </a>

        </div>

        <div class="presenciales-container-container">
            <div class="presenciales-container">
                <Presencialbox v-for="presencial in presenciales" v-bind:key="presencial.id" :data="presencial" :admin="admin"></Presencialbox>
            </div>
        </div>
        

    </div>
</template>
<script>
export default {
    props: ['pack','token', 'admin'],
    data() {
        return {
            presenciales: [],
        }
    },
    created() {
        this.fetchPresencial()
    },
    methods: {
        
        async fetchPresencial() {
    
                fetch(`/api/presenciales/${this.pack.id}`, {
                    headers: {
                        "Authorization": `Bearer ${this.token}`,
                    },
                    method: 'GET',
                }).then(res => res.json()).then(res => {

                    this.presenciales = res.data;
                    //console.log(this.presenciales);

                }).catch(err => console.log(err));
                },

    },
}
</script>