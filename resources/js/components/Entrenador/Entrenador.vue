<template>
    <div class="entrenador-box">
        <img :src="entrenador.image_profile" alt=""> 
        <div class="title-div">
            <h2>{{entrenador.name}}</h2>
        </div>
        <p class="description">{{entrenador.description}}</p>

        <!--
        <a class="edit-icon" v-if="admin" :href="'/admin/settings/edit-presencial/' + data.id">
            <i id="editIcon" style="margin: auto;" class="fa fa-pencil" aria-hidden="true"></i>
        </a>
         -->
        <a class="text-success" :href='"/admin/settings/edit-entrenador/"+entrenador.id'>Editar</a>

    </div>
</template>

<script>
export default {
    
    props: ['data'],
    
    data() {
        return {
            entrenador: {
                id: '',
                name: '',
                image_profile: '',
                description: '',
            },
        }
    },

    created() {
        this.entrenador.id = this.data.id;    
        this.entrenador.name = this.data.name;    
        this.entrenador.image_profile = this.data.entrenador.image_profile;    
        this.entrenador.description = this.data.entrenador.description;    
    },
}
</script>