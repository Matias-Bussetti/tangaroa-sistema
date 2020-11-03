<template>
    <div>
        <div>

            <h3>Agregar Paquete:</h3>

            <form @submit.prevent="addPack" class="col s12 mb-2">

                <div class="row">
                    <div class="input-field col s12">
                        <input v-bind:class="[{'invalid': errors.name}]" class="form-control" type="text" name="name"
                            id="name" v-model="pack.name">
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
                        <textarea v-bind:class="[{'invalid': errors.description}]" class="materialize-textarea"
                            name="description" id="description" v-model="pack.description"></textarea>
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
                        <input v-bind:class="[{'invalid': errors.price}]" class="form-control" type="number"
                            name="price" id="price" v-model="pack.price">
                        <label for="price">Precio</label>
                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.price" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="file-field input-field">
                    <div class="btn">
                        <span>Abrir</span>
                        <input v-bind:class="[{'is-invalid': errors.image}]" class="form-control" type="file"
                            name="image" id="image" @change="changeImage" accept="image/png, image/jpeg">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                    <ul class="invalid-error">
                        <li v-for="(value, index) in errors.image" v-bind:key="index">
                            {{ value }}
                        </li>
                    </ul>
                </div>

                <div style="margin: auto;">
                    <div id="preview">
                        <img class="img-fluid" width="650" v-if="pack.image" :src="pack.image">
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-block mt-4">Agregar Paquete</button>

            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            csrfToken: String,
        },
        data() {
            return {
                errors: {
                    name: '',
                    description: '',
                    price: '',
                    image: '',
                },
                pack: {
                    token: null,
                    name: null,
                    description: null,
                    price: null,
                    image: '',
                },
                image_file: null,
            }
        },

        methods: {
            async addPack() {

                const formData = new FormData();

                formData.append('csrf-token', this.csrfToken);

                if (this.pack.name) {
                    formData.append('name', this.pack.name);
                }

                if (this.pack.description) {
                    formData.append('description', this.pack.description);
                }

                if (this.pack.price) {
                    formData.append('price', this.pack.price);
                }

                if (this.image_file) {
                    formData.append('image', this.image_file);
                }

                await fetch('/get-personal/token')
                    .then(res => res.json())
                    .then(res => {
                        this.token = res.data;
                        //console.log(res.data);
                    })
                    .catch(err => console.log(err));

                fetch('api/pack', {
                    method: 'POST',
                    body: formData,
                    headers: { 
                        "Authorization" : `Bearer ${this.token}`
                             }
                }).then(res => res.json()).then(res => {

                    if(res.data.errors != null){
                        this.errors = res.data.errors;
                    }

                }).catch(err => console.log(err));

            },

            changeImage(e) {
                const file = e.target.files[0];
                this.image_file = file;
                console.log(file);
                this.pack.image = URL.createObjectURL(file);
            },
        },

    }
</script>

<style scoped>

    .input-field .invalid {
     border-bottom: 1px solid #f00;
     box-shadow: 0 1px 0 0 #f00;
   }

   .invalid-error {
     color: #e3342f;
   }

</style>