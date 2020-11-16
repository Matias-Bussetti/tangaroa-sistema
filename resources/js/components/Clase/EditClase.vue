<template>
    <div>
        <div>


            <h3>Editar Clase:</h3>

            <form @submit.prevent="editClase" class="col s12 mb-2">

                <div class="row">
                    <div class="input-field col s12">
                        <input v-bind:class="[{'invalid': errors.name}]" class="form-control" type="text" name="name"
                            id="name" v-model="clase.name">
                        <label for="name">Nombre</label>
                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.name" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input v-bind:class="[{'invalid': errors.description}]" class="form-control" type="text"
                            name="description" id="description" v-model="clase.description">
                        <label for="description">Descripción</label>
                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.description" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input v-bind:class="[{'invalid': errors.link}]" class="form-control" type="text" name="link"
                            id="link" v-model="clase.link">
                        <label for="link">Link del Video</label>
                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.link" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>
                    </div>
                </div>



                <button type="submit" class="btn btn-success btn-block mt-12">Guardar Paquete</button>

            </form>

        </div>
    </div>
</template>

<script>
export default {
    props: ['data', 'packId', 'token'],
    data() {
        return {
            clase: {
                id: '',
                name: '',
                description: '',
                link: '',
            },
            errors: {
                name: '',
                description: '',
                description: '',
                link: '',
            },
        }
    },

    created() {
        this.clase = this.data;
    },

    methods: {

        async editClase() {

                const formData = new FormData();

                if (this.clase.name) {
                    formData.append('name', this.clase.name);
                }

                if (this.clase.description) {
                    formData.append('description', this.clase.description);
                }

                if (this.clase.link) {
                    formData.append('link', this.clase.link);
                }

                formData.append('_method', 'PUT');

                fetch(`/api/clase/${this.clase.id}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "Authorization": `Bearer ${this.token}`,
                    }
                }).then(res => res.json()).then(res => {

                    if (res.data.errors != null) {
                        this.errors = res.data.errors;
                    } else {
                        this.errors = [];
                        window.location.href = `/admin/settings/show-pack/${this.packId}`;
                    }

                }).catch(err => console.warn(err));

            },
        
    },
}
</script>