<template>
    <div>

        <div class="pack ml-2 mr-2" :style="{ background: `linear-gradient(180deg, rgba(0,0,0,1) 9%, rgba(0,0,0,0.9164040616246498) 15%, rgba(0,212,255,0) 100%), url('${data.image_vertical}')` }">
            <h4 class="title">{{data.name}}</h4>
            <p>{{data.description}}</p>
            <h2 v-if="data.date_offer">Oferta Hasta el {{new Date(data.date_offer).getDate()}}/{{new Date(data.date_offer).getMonth()}}</h2>
            <h1>${{data.price_offer ? data.price_offer : data.price}}</h1>
            <a :href="('/paypal/pay/' + data.id)">Pay</a>
        </div>
        
    </div>
</template>

<script>
export default {
    props:['data'],
}
</script>

<style scope>
    .pack {
        width: 300px;
        height: 800px;
        text-align: center;
        background: linear-gradient(180deg, rgba(0,0,0,1) 0%, rgba(0,0,0,0.9164040616246498) 35%, rgba(0,212,255,0) 100%);
        /*transition: height 6s;*/
        /*position: relative;*/
    }

    .pack:hovera {
        -webkit-filter: blur(4px);
        -moz-filter: blur(4px);
        -ms-filter: blur(4px);
        filter: blur(4px);
    }


    .pack .title{
        font-family: 'Carter One', cursive;
        font-style: italic;
        color: #EEE36A;
        top: 15%;
        display: inline-block;
    }

    

    .loaded {
        height: 800px;
    }

</style>