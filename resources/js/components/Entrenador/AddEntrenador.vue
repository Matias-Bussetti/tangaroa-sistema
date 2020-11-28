<template>
    <div>
        <div>

            <h3>Agregar Entrenador:</h3>

            <form @submit.prevent="addEntrenador" class="col s12 mb-2">

                <div class="row">
                    <div class="input-field col s12">
                        <input v-bind:class="[{'invalid': errors.name}]" class="form-control" type="text" name="name"
                            id="name" v-model="entrenador.name">
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
                        <input v-bind:class="[{'invalid': errors.email}]" class="materialize-textarea"  type="email"
                            name="email" id="email" v-model="entrenador.email">
                        <label for="email">Email</label>
                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.email" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input v-bind:class="[{'invalid': errors.password}]" class="materialize-textarea" type="password"
                            name="password" id="password" v-model="entrenador.password">
                        <label for="password">Contraseña</label>
                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.password" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea v-bind:class="[{'invalid': errors.description}]" class="materialize-textarea"
                            name="description" id="description" v-model="entrenador.description"></textarea>
                        <label for="description">Descripción</label>
                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.description" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="file-field input-field">

                    <h4>Imagen de Perfil</h4>

                    <div class="btn col s12 mb-4">
                        <span>Abrir</span>
                        <input class="form-control" type="file" name="image_profile" id="image_file_profile"
                            @change="changeImageProfile" accept="image/png, image/jpeg">
                        <div class="file-path-wrapper" hidden>
                            <input class="file-path validate" type="text">
                        </div>
                    </div>

                    <vue-croppie style="margin: auto;" ref="imgProfile" :enableOrientation="false"
                        :enableResize="false" :viewport="{ width:300, height:300, 'type':'square' }"
                        :boundary="{ width: 300, height: 300}">
                    </vue-croppie>


                    <ul class="invalid-error" v-bind:class="[{'invalid-top': errors.image_profile}]">
                        <li v-for="(value, index) in errors.image_profile" v-bind:key="index">
                            {{ value }}
                        </li>
                    </ul>

                </div>


                <button type="submit" class="btn btn-success btn-block mt-12">Agregar Entrenador</button>

            </form>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue';
    import VueCroppie from 'vue-croppie';
    import 'croppie/croppie.css' // import the croppie css manually

    export default {
        props: ['token'],
        data() {
            return {
                errors: {
                    name: '',
                    description: '',
                    email: '',
                    price: '',
                    image: '',
                },
                entrenador: {
                    name: null,
                    email: null,
                    description: null,
                    password: null,
                    imageProfile: '',
                },
                image_file_profile: null,
            }
        },

        created() {
        },

        mounted() {
            this.$refs.imgProfile.bind({
                url: '/img/page/300x300.png',
            });
        },

        methods: {

            async addEntrenador() {

                //Recorta las imagenes
                let options = {
                    format: 'jpeg',
                    type: 'base64',
                    circle: false,
                    quality: 0.9,
                }

                await this.$refs.imgProfile.result(options, (output) => {

                    var arr = output.split(','),
                        mime = arr[0].match(/:(.*?);/)[1],
                        bstr = atob(arr[1]),
                        n = bstr.length,
                        u8arr = new Uint8Array(n);

                    while (n--) {
                        u8arr[n] = bstr.charCodeAt(n);
                    }

                    this.image_file_profile = new File([u8arr], 'image-profile.jpeg', {
                        type: 'image/jpeg'
                    });

                });

                const formData = new FormData();

                if (this.entrenador.name) {
                    formData.append('name', this.entrenador.name);
                }

                if (this.entrenador.email) {
                    formData.append('email', this.entrenador.email);
                }

                if (this.entrenador.password) {
                    formData.append('password', this.entrenador.password);
                }

                if (this.entrenador.description) {
                    formData.append('description', this.entrenador.description);
                }

                if (this.image_file_profile) {
                    formData.append('image_profile', this.image_file_profile);
                }

                fetch('/api/entrenador', {
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
                        window.location.href = '/admin/settings/';
                    }

                }).catch(err => console.log(err));

            },

            changeImageProfile(e) {

                const file = e.target.files[0];
                //this.image_file_vertical = file;
                this.entrenador.imageProfile = URL.createObjectURL(file);

                this.$refs.imgProfile.bind({
                    url: this.entrenador.imageProfile,
                });

            },

            dataURLtoFile(dataurl, filename) {

                var arr = dataurl.split(','),
                    mime = arr[0].match(/:(.*?);/)[1],
                    bstr = atob(arr[1]),
                    n = bstr.length,
                    u8arr = new Uint8Array(n);

                while (n--) {
                    u8arr[n] = bstr.charCodeAt(n);
                }

                return new File([u8arr], filename, {
                    type: mime
                });
            },

        },

    }
</script>

<style scoped>

.input-field .invalid {
    border-bottom: 1px solid #f00;
    box-shadow: 0 1px 0 0 #f00;
}

.input-field .invalid-top {
    border-top: 2px solid #f00;
    box-shadow: 0 0 -2px 0 #f00;
}

.invalid-error {
    color: #e3342f;
}

img {
    display: block;

    /* This rule is very important, please don't ignore this */
    max-width: 100%;
}

</style>