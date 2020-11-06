<template>
    <div>
        <h1>Paquetes</h1>

        <div class="">

            <div v-if="loading" class="text-center m-5">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div v-if="!loading" class="scrollx">
                <div class="m-auto pb-3" v-for="pack in packs" v-bind:key="pack.id">
                    <pack :pack="{ pack }"></pack>
                </div>
            </div>

        </div>


    </div>
</template>

<script>
import axios from 'axios';

export default {
    
    data() {
        return {
            loading: true,
            token: '',
            packs: [],
            pack: {
                id: '',
                name: '',
                description: '',
                price: '',
                image_vertical: '',
                image_horizontal: '',
            },
        }
    },

    created(){
        this.fetchPacks();
    },
    

    methods: {
        async fetchPacks() {
            let vm = this;

            await fetch('/get-personal/token')
            .then(res => res.json())
            .then(res => { 
                this.token = res.data;
                //console.log(res.data); 
            })
            .catch(err => console.log(err));

            fetch('/api/pack' , 
            { headers: {
                "Authorization" : `Bearer ${this.token}` } 
            }).then(res => res.json()).then(res => {

                    this.packs = res.data;
                    this.loading = false;

            }).catch(err => console.log(err));
        },

        
    },
}
</script>

<style scope>
.scrollx {
    display: flex;
    overflow-x: scroll;
}

/* SCROLL BAR */
/* width */
::-webkit-scrollbar {
  width: 2px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: rgb(184, 184, 184);
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: rgb(148, 148, 148);
}

</style>