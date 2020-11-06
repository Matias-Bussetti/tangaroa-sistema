<template>
    <div>

        <div v-if="loading" class="text-center m-auto w-auto">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div v-if="!loading" class="pack ml-2 mr-2" :class="{loaded: expand}" :style="{ background: `linear-gradient(180deg, rgba(0,0,0,1) 9%, rgba(0,0,0,0.9164040616246498) 15%, rgba(0,212,255,0) 100%), url('${pack.pack.image_vertical}')` }">
            <!-- <img :src="pack.pack.image_vertical" alt=""> -->
            <h4 class="title">{{pack.pack.name}}</h4>
            <button @click="deletePack(pack.pack.id)">X</button>
            
           
        </div>
    </div>
</template>

<script>
export default {
    props:[ 'pack' ],
    data() {
        return {
            loading: true,
            expand: false,
        }
    },

    mounted() {
        setTimeout(() => this.loading = false, 500);
        //setTimeout(() => this.expand = true, 1500);
    },

    methods: {
        async deletePack(id) {
            let vm = this;

            await fetch('/get-personal/token')
            .then(res => res.json())
            .then(res => { 
                this.token = res.data;
                //console.log(res.data); 
            })
            .catch(err => console.log(err));

            fetch(`api/pack/${id}` , 
            { headers: {
                "Authorization" : `Bearer ${this.token}` ,
                },
                method: 'DELETE', 
            }).then(res => res.json()).then(res => {

                    this.packs = res.data;
                    this.loading = false;

            }).catch(err => console.log(err));
        },
    },
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