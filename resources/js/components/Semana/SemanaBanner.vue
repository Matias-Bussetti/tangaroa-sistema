<template>
    <div>
        <div class="semana" :style="{ 'background-color': semana.color }">

            <h4 class="stitle" :style="{ 'display': (!edit ? 'unset' : 'none') }">{{semana.name}}</h4>

            <div class="edit-form">

                <input v-if="admin" :id="(semana.name + '-inputText')" type="text" class="input-text"
                    v-model="semana.name" :style="{ 'display': (edit ? 'unset' : 'none') }">

                <input v-if="admin" :id="(semana.name + '-inputColor')" type="color" class="input-color"
                    v-model="semana.color" :style="{ 'display': (edit ? 'unset' : 'none') }">

            </div>

            <i v-if="admin" id="editIcon" class="edit-icon fa " :class="[edit ? 'fa-save': 'fa-pencil']"
                aria-hidden="true" @click="editSemana"></i>

        </div>

        <div class="clase-container-container">
            <div class="clase-container">

                <slot></slot>

                <Clasesmallbox v-for="clase in clases" :key="clase.id" :data="clase" :admin="admin" :index="'n'"></Clasesmallbox>

                <div class="clase-box" style="padding: 56px;" v-if="admin && counter<5" @click="addClase">
                    <i data-v-fc6ec140="" aria-hidden="true" class="m-auto fa fa-plus"></i>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
export default {
    props: ['data', 'token', 'admin', 'count'],
    data() {
        return {
            semana: {
                id: '',
                name: '',
                color: '',
            },
            edit: false,
            clases: [],
            counter: '',
        }
    },

    created() {
        this.semana = this.data
        this.counter = this.count
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
                this.counter++
                this.clases.push(res.data);
                //console.log(this.clases)

            }).catch(err => console.log(err));
        },

    },
     computed: {
         position: function() {
             return count;
         }
     }
}
</script>


    