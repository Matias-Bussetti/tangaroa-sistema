<template>
    <div>
        
        <img :src="entrenador.image_profile" alt=""> 
        <h2>{{entrenador.name}}</h2>
        <p>{{entrenador.description}}</p>
        <a :href='"/admin/settings/edit-entrenador/"+entrenador.id'>Edit</a>
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