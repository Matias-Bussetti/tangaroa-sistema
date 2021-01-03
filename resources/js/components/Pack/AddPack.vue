<template>
    <div>
        <div>

            <h3>Agregar Paquete:</h3>

            <form @submit.prevent="addPack" class="col s12 mb-2">

                <div class="form-div">

                        <label for="name">Nombre</label> 
                    
                        <input v-bind:class="[{'invalid': errors.name}]" class="input" type="text" name="name"
                            id="name" v-model="pack.name">
                    
                </div>
                    
                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.name" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>

                <div class="form-div">
                
                        <label for="description">Descripción</label>
                
                        <textarea v-bind:class="[{'invalid': errors.description}]" class="input"
                            name="description" id="description" v-model="pack.description"></textarea>
                
                </div>
                
                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.description" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>

                <div class="form-div">
                
                        <label for="price">Precio</label>
                
                        <input v-bind:class="[{'invalid': errors.price}]" class="input" type="number"
                            name="price" id="price" v-model="pack.price"  step=".01">
                
                </div>
                
                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.price" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>

                <div class="form-div">
                
                        <label for="price">Tipo de Paquete</label>
                
                        <!-- <input v-bind:class="[{'invalid': errors.price}]" class="input" type="number"
                            name="price" id="price" v-model="pack.price"  step=".01"> -->
                            <div>
                                <div class="text-nowrap">
                                    <input id="grabada" type="radio" name="type" value="0" v-model="pack.type">
                                    <label for="grabada">Clases Grabadas</label>
                                </div>

                                <div class="text-nowrap">
                                    <input id="presencial" type="radio" name="type" value="1" v-model="pack.type">
                                    <label for="presencial">Clases Presenciales</label>
                                </div>
                            </div>
                
                </div>

                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.type" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>

                <div class="form-croppie">

                    <h4>Imagen Vertical</h4>

                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image_vertical" id="image_file_vertical" @change="changeImageVertical" accept="image/png, image/jpeg" lang="es">
                            <label class="custom-file-label" for="image_file_profile">Elegir una Imagen</label>
                        </div>
                    </div>

                    <vue-croppie style="margin: auto;" ref="imgVertical" :enableOrientation="false"
                        :enableResize="false" :viewport="{ width:300, height:800, 'type':'square' }"
                        :boundary="{ width: 300, height: 800}">
                    </vue-croppie>


                </div>

                    <ul class="invalid-error" v-bind:class="[{'invalid-top': errors.image_vertical}]">
                        <li v-for="(value, index) in errors.image_vertical" v-bind:key="index">
                            {{ value }}
                        </li>
                    </ul>

                <div class="form-croppie">

                    <h4>Imagen Horizontal</h4>

                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image_horizontal" id="image_file_horizontal" @change="changeImageHorizontal" accept="image/png, image/jpeg" lang="es">
                            <label class="custom-file-label" for="image_file_profile">Elegir una Imagen</label>
                        </div>
                    </div>

                    <div class="scroll-x">

                        <vue-croppie style="margin: auto;" ref="imgHorizontal" :enableOrientation="false"
                        :enableResize="false" :viewport="{ width: 1600, height: 200, 'type':'square' }"
                        :boundary="{ width: 1600, height: 200}">
                    </vue-croppie>

                    </div>


                </div>

                    <ul class="invalid-error" v-bind:class="[{'invalid-top': errors.image_horizontal}]">
                        <li v-for="(value, index) in errors.image_horizontal" v-bind:key="index">
                            {{ value }}
                        </li>
                    </ul>

                <button type="submit" class="submit-button">Agregar Paquete</button>

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
                    price: '',
                    image: '',
                    type: '',
                },
                pack: {
                    name: null,
                    description: null,
                    price: null,
                    imageVertical: '',
                    imageHorizontal: '',
                    type: '',
                },
                image_file_vertical: null,
                image_file_horizontal: null,
            }
        },

        created() {

        },

        mounted() {
            this.$refs.imgVertical.bind({
                url: '/img/page/300x800.png',
            });
            this.$refs.imgHorizontal.bind({
                url: '/img/page/1600x200.png',
            });
        },

        methods: {
            async addPack() {

                //Recorta las imagenes
                let options = {
                    format: 'jpeg',
                    type: 'base64',
                    circle: false,
                    quality: 0.9,
                }

                await this.$refs.imgVertical.result(options, (output) => {

                    var arr = output.split(','),
                        mime = arr[0].match(/:(.*?);/)[1],
                        bstr = atob(arr[1]),
                        n = bstr.length,
                        u8arr = new Uint8Array(n);

                    while (n--) {
                        u8arr[n] = bstr.charCodeAt(n);
                    }

                    this.image_file_vertical = new File([u8arr], 'image-vertical.jpeg', {
                        type: 'image/jpeg'
                    });

                });

                await this.$refs.imgHorizontal.result(options, (output) => {

                    var arr = output.split(','),
                        mime = arr[0].match(/:(.*?);/)[1],
                        bstr = atob(arr[1]),
                        n = bstr.length,
                        u8arr = new Uint8Array(n);

                    while (n--) {
                        u8arr[n] = bstr.charCodeAt(n);
                    }

                    this.image_file_horizontal = new File([u8arr], 'image-horizontal.jpeg', {
                        type: 'image/jpeg'
                    });
                });

                const formData = new FormData();

                if (this.pack.name) {
                    formData.append('name', this.pack.name);
                }

                if (this.pack.description) {
                    formData.append('description', this.pack.description);
                }

                if (this.pack.price) {
                    formData.append('price', this.pack.price);
                }

                if (this.pack.type) {
                    formData.append('type', this.pack.type);
                }

                if (this.image_file_vertical) {
                    formData.append('image_vertical', this.image_file_vertical);
                }

                if (this.image_file_horizontal) {
                    formData.append('image_horizontal', this.image_file_horizontal);
                }

                fetch('/api/pack', {
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

            changeImageVertical(e) {

                const file = e.target.files[0];
                //this.image_file_vertical = file;
                this.pack.imageVertical = URL.createObjectURL(file);

                this.$refs.imgVertical.bind({
                    url: this.pack.imageVertical,
                });

            },

            changeImageHorizontal(e) {

                const file = e.target.files[0];
                //this.image_file_vertical = file;
                this.pack.imageHorizontal = URL.createObjectURL(file);

                this.$refs.imgHorizontal.bind({
                    url: this.pack.imageHorizontal,
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