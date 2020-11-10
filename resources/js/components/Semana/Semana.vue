<template>
    <div>
        <div class="row align-middle" :style="{ 'background-color': semana.color }">
            <h4 class="col-11" :style="{ 'display': (!edit ? 'unset' : 'none') }">{{semana.name}}</h4>
            <input :id="(semana.name + '-inputText')" type="text" class="col-11 input-text" v-model="semana.name" :style="{ 'display': (edit ? 'unset' : 'none') }">
            <input :id="(semana.name + '-inputColor')" type="color" class="input-color"  v-model="semana.color" :style="{ 'display': (edit ? 'unset' : 'none') }">
            <i id="editIcon" style="margin: auto;" class="fa " :class="[edit ? 'fa-save': 'fa-pencil']" aria-hidden="true" @click="editSemana"></i>
        </div>
        
    </div>
</template>

<script>

export default {
    
    props: ['data','token'],

    data() {
        return {
            semana: {
                id: '',
                name: '',
                color: '',
            },
            edit: false,
        }
    },

    created() {
        this.semana = JSON.parse(this.data);
        this.semana.color = this.semana.color
    },

    methods: {

        async editSemana(){

            this.edit = !this.edit;

            if(!this.edit){

                const formData = new FormData();

                formData.append('name', this.semana.name);

                formData.append('color', this.semana.color);

                formData.append('_method', 'PUT');

                fetch(`/api/semana/${this.semana.id}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "Authorization": `Bearer ${this.token}`,
                    }
                }).then(res => res.json()).then(res => {

                    console.log(res.data);

                    /*if (res.data.errors != null) {
                        this.errors = res.data.errors;
                    } else {
                        this.errors = [];
                    }*/

                }).catch(err => console.warn(err));

            }
        },
    },




}
</script>

<style scoped>
h4 {
    /*display: none;*/
    color: white;
    mix-blend-mode: difference;
}
.input-color{
    width: 30px;
    height: 30px;
}
.input-text {
    color: white;
    mix-blend-mode: difference;
    font-size: 1.35rem;
    background: transparent;
    border: 0px solid white;
}
textarea:focus, input:focus{
    outline: none;
}
</style>
    