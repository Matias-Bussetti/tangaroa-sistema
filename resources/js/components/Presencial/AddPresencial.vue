<template>
    <div>
        <div>

            <h3>Agregar Clase Presencial:</h3>

            <form @submit.prevent="addPresencial" class="col s12 mb-2">

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
                        <label class="btn btn-dark">
                            <input type="radio" name="fecha" value="Monday" autocomplete="off"
                                v-model="presencial.fecha"> Lunes
                        </label>
                        <label class="btn btn-dark">
                            <input type="radio" name="fecha" value="Tuesday" autocomplete="off"
                                v-model="presencial.fecha"> Martes
                        </label>
                        <label class="btn btn-dark">
                            <input type="radio" name="fecha" value="Wednesday" autocomplete="off"
                                v-model="presencial.fecha"> Miércoles
                        </label>
                        <label class="btn btn-dark">
                            <input type="radio" name="fecha" value="Thursday" autocomplete="off"
                                v-model="presencial.fecha"> Jueves
                        </label>
                        <label class="btn btn-dark">
                            <input type="radio" name="fecha" value="Friday" autocomplete="off"
                                v-model="presencial.fecha"> Viernes
                        </label>
                        <label class="btn btn-dark">
                            <input type="radio" name="fecha" value="Saturday" autocomplete="off"
                                v-model="presencial.fecha"> Sábado
                        </label>
                        <label class="btn btn-dark">
                            <input type="radio" name="fecha" value="Sunday" autocomplete="off"
                                v-model="presencial.fecha"> Domigo
                        </label>

                    </div>

                </div>

                <ul class="invalid-error">
                    <li v-for="(value, index) in errors.fecha" v-bind:key="index">
                        {{ value }}
                    </li>
                </ul>

                <button type="submit" class="submit-button">Agregar Paquete</button>

            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['token', 'packId'],
        data() {
            return {
                errors: {
                    name: '',
                    hora_inicio: '',
                    hora_fin: '',
                    fecha: '',
                },
                presencial: {
                    name: '',
                    hora_inicio: '',
                    hora_fin: '',
                    fecha: '',
                },
            }
        },

        methods: {
            async addPresencial() {

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

                formData.append('pack_id', this.packId);


                fetch('/api/presencial', {
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