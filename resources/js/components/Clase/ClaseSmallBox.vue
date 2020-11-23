<template>
    <div>
        <div class="card text-white bg-dark col" style="max-width: 18rem;">
            <div class="card-header">{{clase.name}}</div>
            <a :href="'/my-workout/' + clase.name + '/tag/' + clase.id">View</a>
            <a v-if="admin" :href="'/admin/settings/edit-clase/' + clase.name + '/etiqueta/' + clase.id">edit</a>
        </div>
    </div>
</template>

<script>
export default {
    props: ['data','admin'],
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
}
</script>

<style scoped>
.box{
    width: auto;
    background-color: grey;
    height: 50px;
}
</style>