<template>
    <div>
        <div>

            <h3 class="form-title">Editar Clase Presencial:</h3>

            <form @submit.prevent="editPresencial" class="col s12 mb-2">

                <div class="form-div">

                    <label for="name">Nombre</label>

                    <input v-bind:class="[{'invalid': errors.name}]" class="input" type="text" name="name" id="name"
                        v-model="presencial.name">

                </div>

                <ul class="invalid-error">
                    <li v-for="(value, index) in errors.name" v-bind:key="index">
                        {{ value }}
                    </li>
                </ul>

                <div class="form-div">

                    <label for="hora_inicio">Hora Comienzo</label>

                    <input v-bind:class="[{'invalid': errors.hora_inicio}]" class="input" type="time" name="hora_inicio"
                        id="hora_inicio" v-model="presencial.hora_inicio">

                </div>

                <ul class="invalid-error">
                    <li v-for="(value, index) in errors.hora_inicio" v-bind:key="index">
                        {{ value }}
                    </li>
                </ul>

                <div class="form-div">

                    <label for="hora_fin">Hora Final</label>

                    <input v-bind:class="[{'invalid': errors.hora_fin}]" class="input" type="time" name="hora_fin"
                        id="hora_fin" v-model="presencial.hora_fin">

                </div>

                <ul class="invalid-error">
                    <li v-for="(value, index) in errors.hora_fin" v-bind:key="index">
                        {{ value }}
                    </li>
                </ul>

                <div class="form-div">

                    <label>Día</label>

                    <div class="btn-group btn-group-toggle input" data-toggle="buttons">

                        <label :class='[presencial.fecha == "Monday" ? "active" : ""]' class="btn btn-dark">
                            <input type="radio" name="fecha" value="Monday" autocomplete="off" v-model="presencial.fecha"> Lunes
                        </label>

                        <label :class='[presencial.fecha == "Tuesday" ? "active" : ""]' class="btn btn-dark">
                            <input type="radio" name="fecha" value="Tuesday" autocomplete="off" v-model="presencial.fecha"> Martes
                        </label>
                        
                        <label :class='[presencial.fecha == "Wednesday" ? "active" : ""]' class="btn btn-dark">
                            <input type="radio" name="fecha" value="Wednesday" autocomplete="off" v-model="presencial.fecha"> Miércoles
                        </label>

                        <label :class='[presencial.fecha == "Thursday" ? "active" : ""]' class="btn btn-dark">
                            <input type="radio" name="fecha" value="Thursday" autocomplete="off" v-model="presencial.fecha"> Jueves
                        </label>

                        <label :class='[presencial.fecha == "Friday" ? "active" : ""]' class="btn btn-dark">
                            <input type="radio" name="fecha" value="Friday" autocomplete="off" v-model="presencial.fecha"> Viernes
                        </label>

                        <label :class='[presencial.fecha == "Saturday" ? "active" : ""]' class="btn btn-dark">
                            <input type="radio" name="fecha" value="Saturday" autocomplete="off" v-model="presencial.fecha"> Sábado
                        </label>

                        <label :class='[presencial.fecha == "Sunday" ? "active" : ""]' class="btn btn-dark">
                            <input type="radio" name="fecha" value="Sunday" autocomplete="off" v-model="presencial.fecha"> Domigo
                        </label>

                    </div>

                </div>

                <ul class="invalid-error">
                    <li v-for="(value, index) in errors.fecha" v-bind:key="index">
                        {{ value }}
                    </li>
                </ul>

                <div class="form-div">

                    <label for="link">Link</label>

                    <input v-bind:class="[{'invalid': errors.link}]" class="input" type="text" name="link" id="link"
                        v-model="presencial.link">

                </div>

                <ul class="invalid-error">
                    <li v-for="(value, index) in errors.link" v-bind:key="index">
                        {{ value }}
                    </li>
                </ul>

                <button type="submit" class="submit-button">Editar Clase Presencial</button>

            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id', 'token'],
        data() {
            return {
                errors: {
                    name: '',
                    hora_inicio: '',
                    hora_fin: '',
                    fecha: '',
                    link: '',
                },
                presencial: {
                    id: '',
                    name: '',
                    hora_inicio: '',
                    hora_fin: '',
                    fecha: '',
                    link: '',
                },
            }
        },
        created() {
            this.fetchPresencial()
            console.log("creado");
        },

        mounted() {
            //this.fetchLink()
            console.log("montado");
        },

        methods: {

            async fetchPresencial() {

                await fetch(`/api/presencial/${this.id}`, {
                    headers: {
                        "Authorization": `Bearer ${this.token}`
                    }
                }).then(res => res.json()).then(res => {


                    this.presencial = res.data;
                    console.log(this.presencial);

                    var weekday = ["Monday", "Tuesday", "Wednesday", "Thrusday", "Friday", "Saturday", "Sunday"]
                    this.presencial.fecha = weekday[new Date(this.presencial.fecha).getDay()]


                   

                }).catch(err => console.log(err));

                 await fetch(`/api/presencial/link/${this.presencial.id}`, {
                        headers: {
                            "Authorization": `Bearer ${this.token}`,
                        },
                        method: 'GET',
                    }).then(res => res.json()).then(res => {

                        this.$set(this.presencial, 'link', res.data)
                        console.log(this.presencial);

                        
                    }).catch(err => console.log(err));


            },

            async fetchLink() {

                await fetch(`/api/presencial/link/${this.id}`, {
                    headers: {
                        "Authorization": `Bearer ${this.token}`,
                    },
                    method: 'GET',
                }).then(res => res.json()).then(res => {

                    this.presencial.link = res.data;
                    console.log(this.presencial.link);
                    
                }).catch(err => console.log(err));

            },

            async editPresencial() {

                const formData = new FormData();

                if (this.presencial.name) {
                    formData.append('name', this.presencial.name);
                }

                if (this.presencial.hora_inicio) {
                    formData.append('hora_inicio', this.presencial.hora_inicio);
                }

                if (this.presencial.hora_fin) {
                    formData.append('hora_fin', this.presencial.hora_fin);
                }

                if (this.presencial.fecha) {
                    formData.append('fecha', this.presencial.fecha);
                }

                if (this.presencial.link) {
                    formData.append('link', this.presencial.link);
                }

                formData.append('_method', 'PUT');

                fetch(`/api/presencial/${this.presencial.id}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "Authorization": `Bearer ${this.token}`
                    }
                }).then(res => res.json()).then(res => {

                    if (res.data.errors != null) {
                        this.errors = res.data.errors;
                    } else {
                        this.errors = [];
                        console.log(res.data)
                        window.location.href = `/admin/settings/show-pack/${res.data.name}/tag/${res.data.id}`;
                    }

                }).catch(err => console.log(err));

            },


        },

    }
</script>