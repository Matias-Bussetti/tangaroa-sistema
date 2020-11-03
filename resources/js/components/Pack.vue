<template>
    <div class="row">
        <div>
            <h4>{{pack.pack.name}}</h4>
            <img :src="pack.pack.image" alt="">
        </div>
    </div>
</template>
<script>
export default {
    props:[ 'pack' ],
}
</script>