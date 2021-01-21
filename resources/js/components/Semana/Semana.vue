<template>

    <div>

        <div class="row align-middle" :style="{ 'background-color': semana.color }">

            <h4 class="col-11 title" :style="{ 'display': (!edit ? 'unset' : 'none') }">{{semana.name}}</h4>
            <input :id="(semana.name + '-inputText')" type="text" class="col-11 input-text" v-model="semana.name" :style="{ 'display': (edit ? 'unset' : 'none') }">
            <input :id="(semana.name + '-inputColor')" type="color" class="input-color"  v-model="semana.color" :style="{ 'display': (edit ? 'unset' : 'none') }">
            <i id="editIcon" style="margin: auto;" class="fa " :class="[edit ? 'fa-save': 'fa-pencil']" aria-hidden="true" @click="editSemana"></i>

        </div>

        <div class="row">
            
            <div class="col-1 m-auto" v-for="clase in clases" v-bind:key="clase.id">
                <div class="box ml-4">
                    {{clase.name}}
                    <a :href="'/admin/settings/edit-clase/' + clase.name + '/etiqueta/' + clase.id">edit</a>
                </div>
            </div>

            {{this.clases.length}}
            
            <!-- <div class="col-1 m-auto" v-if="(this.clases || this.clases.length < 5)" @click="addClase">
                <i style="margin: auto;" class="fa fa-plus" aria-hidden="true"></i>
            </div> -->
            
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
            clases: [],
        }
    },

    created() {
        this.semana = JSON.parse(this.data);
        this.clases = this.semana.clases;
    },

    methods: {

        async editSemana() {

            this.edit = !this.edit;

            if (!this.edit) {

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

                    //console.log(res.data);

                    /*if (res.data.errors != null) {
                        this.errors = res.data.errors;
                    } else {
                        this.errors = [];
                    }*/

                }).catch(err => console.warn(err));

            }
        },

        

        async addClase() {

            const formData = new FormData();

            formData.append('semana_id', this.semana.id);

            fetch(`/api/clase` , 
            { headers: {
                "Authorization" : `Bearer ${this.token}` ,
                },
                body: formData,
                method: 'POST', 
            }).then(res => res.json()).then(res => {
                this.clases.push(res.data);
            }).catch(err => console.log(err));
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
    