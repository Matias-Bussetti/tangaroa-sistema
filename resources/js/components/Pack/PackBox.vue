<template>
   
    <div class="box">
   
        <!-- <a :href="( admin ? '/admin/settings/show-pack/' + data.name + '/tag/' + data.id   : '/my-pack/'+data.name+'/tag/'+data.id)">

            <div class="title-container">
                <h4>{{data.name}}</h4>
            </div>
        -->
        <img v-if="!fill" :id="data.name.replaceAll(' ', '-')" class="img" :src="data.image_cuadrado" :alt="data.name">
        <img v-else class="img" src="/img/page/tangaroa logo.jpg" alt="Tangaroa">
        
        <div v-if="!fill" class="container-name">
            <h2>{{data.name}}</h2>
        </div>
        
        <div v-if="!fill" class="container-subname">
            <h4>"{{data.subname}}"</h4>
        </div>
            <!--
            <div class="link-container">
                <i class="fas fa-dumbbell"></i>
            </div>
        </a>
            -->
   
    </div>

</template>

<script>
export default {
    props:['fill','data','admin'],
}
</script>