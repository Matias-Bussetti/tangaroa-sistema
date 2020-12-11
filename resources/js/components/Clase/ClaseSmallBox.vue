<template>

    <div @click="viewWorkout" class="clase-box">

        <h3 class="title">
                {{clase.name}}
        </h3>

        <i class="far fa-times-circle text-danger"></i>
        <!-- <i class="far fa-check-circle text-success"></i> -->

        <p>Día {{index}} de 5</p>

        <a class="edit-icon" v-if="admin" :href="'/admin/settings/edit-clase/' + clase.name + '/etiqueta/' + clase.id">
            <i class="fa fa-pencil" aria-hidden="true"></i>
        </a>

    </div>

</template>

<script>
export default {
    props: ['data', 'admin', 'index'],
    data() {
        return {
            clase: {
                id: '',
                name: '',
            },
        }
    },

    created() {
        this.clase.id = this.data.id;
        this.clase.name = this.data.name;
    },

    methods: {
        viewWorkout() {
            window.location.href = `/my-workout/${this.clase.name}/tag/${this.clase.id}`;
        }
    },
}
</script>
