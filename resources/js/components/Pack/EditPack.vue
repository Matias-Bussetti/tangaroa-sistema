<template>
    <div>
        <div>

            <h3 class="form-title">Agregar Paquete:</h3>

            <form @submit.prevent="editPack" class="col s12 mb-2">

                <div class="form-div">

                        <label for="name">Nombre</label>

                        <input v-bind:class="[{'invalid': errors.name}]" class="input" type="text" name="name"
                            id="name" v-model="pack.name">

                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.name" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>

                </div>

                <div class="form-div">

                        <label for="name">Subnombre</label> 
                    
                        <input v-bind:class="[{'invalid': errors.subname}]" class="input" type="text" name="subname"
                            id="name" v-model="pack.subname">
                    
                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.subname" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>
                
                </div>
                    

                <div class="form-div">

                        <label for="description">Descripción</label>

                        <textarea v-bind:class="[{'invalid': errors.description}]" class="input"
                            name="description" id="description" v-model="pack.description"></textarea>

                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.description" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>

                </div>

                <div class="form-div">

                        <label for="price">Precio</label>

                        <input v-bind:class="[{'invalid': errors.price}]" class="input" type="number"
                            name="price" id="price" v-model="pack.price" step=".01">

                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.price" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>

                </div>

                <div class="form-div">


                        <label for="date_offer">F. limite de oferta</label>

                        <input v-bind:class="[{'invalid': errors.date_offer}]" class="input" type="date"
                            name="date_offer" id="date_offer" v-model="pack.date_offer">

                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.date_offer" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>

                    </div>

                    <div class="form-div">

                        <label for="price_offer">Precio de Oferta</label>

                        <input v-bind:class="[{'invalid': errors.price_offer}]" class="input" type="number"
                            name="price_offer" id="price_offer" v-model="pack.price_offer" step=".01">

                        <ul class="invalid-error">
                            <li v-for="(value, index) in errors.price_offer" v-bind:key="index">
                                {{ value }}
                            </li>
                        </ul>

                    </div>

                <div class="form-croppie">

                    <h4>Imagen Cuadrado</h4>

                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image_cuadrado" id="image_file_cuadrado" @change="changeImageCuadrado" accept="image/png, image/jpeg" lang="es">
                            <label class="custom-file-label" for="image_file_profile">Elegir una Imagen</label>
                        </div>
                    </div>

                    <vue-croppie style="margin: auto;" ref="imgCuadrado" :enableOrientation="false"
                        :enableResize="false" :viewport="{ width:800, height:800, 'type':'square' }"
                        :boundary="{ width: 800, height: 800}">
                    </vue-croppie>

                    <ul class="invalid-error" v-bind:class="[{'invalid-top': errors.image_cuadrado}]">
                        <li v-for="(value, index) in errors.image_cuadrado" v-bind:key="index">
                            {{ value }}
                        </li>
                    </ul>

                </div>

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

                    <ul class="invalid-error" v-bind:class="[{'invalid-top': errors.image_vertical}]">
                        <li v-for="(value, index) in errors.image_vertical" v-bind:key="index">
                            {{ value }}
                        </li>
                    </ul>

                </div>

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

                    <ul class="invalid-error" v-bind:class="[{'invalid-top': errors.image_horizontal}]">
                        <li v-for="(value, index) in errors.image_horizontal" v-bind:key="index">
                            {{ value }}
                        </li>
                    </ul>

                </div>

                <button type="submit" class="submit-button">Guardar Paquete</button>

            </form>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue';
    import VueCroppie from 'vue-croppie';
    import 'croppie/croppie.css' // import the croppie css manually
    export default {
        props: ['id','token'],
        data() {
            return {
                errors: {
                    name: '',
                    description: '',
                    price: '',
                    image: '', // ?
                },
                pack: {
                    name: null,
                    subname: null,
                    description: null,
                    price: null,
                    image_cuadrado: '',
                    image_vertical: '',
                    image_horizontal: '',
                    price_offer: null,
                    date_offer: null,
                },
                image_file_cuadrado: null,
                image_file_vertical: null,
                image_file_horizontal: null,
            }
        },

        created() {
            this.fetchPack();
        },

        methods: {

            async fetchPack() {

                await fetch(`/api/pack/${this.id}`, {
                    headers: {
                        "Authorization": `Bearer ${this.token}`
                    }
                }).then(res => res.json()).then(res => {

                        this.pack = res.data;

                        console.log(res.data);
                        
                        this.$refs.imgCuadrado.bind({
                            url: res.data.image_cuadrado,
                        });

                        this.$refs.imgVertical.bind({
                            url: res.data.image_vertical,
                        });

                        this.$refs.imgHorizontal.bind({
                            url: res.data.image_horizontal,
                        });


                    }).catch(err => console.log(err));
            },

            async editPack() {

                //Recorta las imagenes
                let options = {
                    format: 'jpeg',
                    type: 'base64',
                    circle: false,
                    quality: 1,
                }

                await this.$refs.imgCuadrado.result(options, (output) => {

                    var arr = output.split(','),
                        mime = arr[0].match(/:(.*?);/)[1],
                        bstr = atob(arr[1]),
                        n = bstr.length,
                        u8arr = new Uint8Array(n);

                    while (n--) {
                        u8arr[n] = bstr.charCodeAt(n);
                    }

                    this.image_file_cuadrado = new File([u8arr], 'image-cuadrado.jpeg', {
                        type: 'image/jpeg'
                    });
                });

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

                if (this.pack.subname) {
                    formData.append('subname', this.pack.subname);
                }

                if (this.pack.description) {
                    formData.append('description', this.pack.description);
                }

                if (this.pack.price) {
                    formData.append('price', this.pack.price);
                }

                if (this.pack.date_offer) {
                    formData.append('date_offer', this.pack.date_offer);
                }

                if (this.pack.price_offer) {
                    formData.append('price_offer', this.pack.price_offer);
                }

                if (this.image_file_cuadrado) {
                    formData.append('image_cuadrado', this.image_file_cuadrado);
                }

                if (this.image_file_vertical) {
                    formData.append('image_vertical', this.image_file_vertical);
                }

                if (this.image_file_horizontal) {
                    formData.append('image_horizontal', this.image_file_horizontal);
                }

                formData.append('_method', 'PUT');

                fetch(`/api/pack/${this.id}`, {
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
                        window.location.href = `/admin/settings/show-pack/${this.pack.name}/tag/${this.id}`;
                    }

                }).catch(err => console.warn(err));

            },

            changeImageCuadrado(e) {

                const file = e.target.files[0];
                this.pack.image_horizontal = URL.createObjectURL(file);
                this.image_change_horizontal = true;
                this.$refs.imgHorizontal.bind({
                    url: this.pack.image_horizontal,
                });

            },

            changeImageVertical(e) {

                const file = e.target.files[0];
                this.pack.image_vertical = URL.createObjectURL(file);
                this.image_change_vertical = true;
                this.$refs.imgVertical.bind({
                    url: this.pack.image_vertical,
                });

            },

            changeImageHorizontal(e) {

                const file = e.target.files[0];
                this.pack.image_horizontal = URL.createObjectURL(file);
                this.image_change_horizontal = true;
                this.$refs.imgHorizontal.bind({
                    url: this.pack.image_horizontal,
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