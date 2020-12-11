<template>
    <div>

        <div class="delimitador">

            <h1 class="ml-1">{{clase.name}}</h1>

            <div class="contenedor">
                <iframe :src="clase.link" class="video" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
            </div>
            
        </div>

        <a href="#">Hecho</a>

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
                link: '',
            }
        }
    },
    created() {
        this.clase = this.data;
    },
}
</script>

<style scoped>

    /* Para tener un ancho máximo debemos de establecer el width del DIV.delimitador */
    .delimitador {
        min-width: 320px;
        max-width: 720px;
        margin: auto;
    }

    /* El contenedor con el padding-top crea el tamaño del vídeo */
    .contenedor {
        height: 0px;
        width: 100%;
        max-width: 720px;
        /* Así establecemos el ancho máximo (si lo queremos) */
        padding-top: 56.25%;
        /* Relación: 16/9 = 56.25% */
        position: relative;
    }

    /* El iframe se adapta al tamaño del contenedor */
    iframe {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0px;
        left: 0px;
    }

</style>