<template>
    <div>
        <div class="col-12">
            <div style="display: flex;">

                <img class="col-12" :src="data.image_horizontal" alt="">

                <h1 class="title">{{data.name}}</h1>

                <a :href="'/admin/settings/edit-pack/' + data.id"><i id="editIcon" style="margin: auto;" class="fa fa-pencil" aria-hidden="true"></i></a>
                
            </div>
           <slot></slot>   
        </div>
    </div>
</template>

<script>
export default {
    props: ['data'],
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