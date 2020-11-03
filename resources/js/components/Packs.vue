<template>
    <div>   
        <h1>Packs</h1>
        <div v-for="pack in packs" v-bind:key="pack.id">
            <!--<h2>{{pack.name}}</h2>-->
            <pack :pack="{ pack }"></pack>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    
    data() {
        return {
            token: '',
            packs: [],
            pack: {
                id: '',
                name: '',
                description: '',
                price: '',
                image: '',
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

                    //console.log(res.data);
                    this.packs = res.data;

            }).catch(err => console.log(err));
        },

        
    },
}
</script>