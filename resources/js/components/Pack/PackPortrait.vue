<template>
   
    <div class="portrait" :style="`background: linear-gradient(180deg, rgba(0,0,0,1) 0%, rgba(0,0,0,0.9164040616246498) 15%, rgba(0,212,255,0) 100%), url('${data.image_vertical}');`">
   
        <a :href="( admin ? '/admin/settings/show-pack/' + data.name + '/tag/' + data.id   : '/my-pack/'+data.name+'/tag/'+data.id)">

            <div class="title-container">
                <h4>{{data.name}}</h4>
            </div>

            <div class="link-container">
                <i class="fas fa-dumbbell"></i>
            </div>

        </a>
   
    </div>

</template>

<script>
export default {
    props:['data','admin'],
}
</script>