<template>
    <div>
        <div class="box ml-4">
        {{clase.name}}
        </div>
    </div>
</template>
<script>
export default {
    props: ['data'],
    data() {
        return {
            clase: {
                id: '',
                name: '',
                description: '',
                link: ''
            },
        }
    },

    created() {
        this.clase = JSON.parse(this.data);
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