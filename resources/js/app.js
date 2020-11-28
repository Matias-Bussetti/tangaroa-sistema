/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('Packs', require('./components/Pack/Packs.vue').default);
Vue.component('Pack', require('./components/Pack/Pack.vue').default);
Vue.component('Packbanner', require('./components/Pack/PackBanner.vue').default);
Vue.component('Addpack', require('./components/Pack/AddPack.vue').default);
Vue.component('Editpack', require('./components/Pack/EditPack.vue').default);

Vue.component('Packportrait', require('./components/Pack/PackPortrait.vue').default);
Vue.component('Packsale', require('./components/Pack/PackSale.vue').default);


Vue.component('Packsemanas', require('./components/Semana/PackSemanas.vue').default);
Vue.component('Semana', require('./components/Semana/Semana.vue').default);
Vue.component('Semanabanner', require('./components/Semana/SemanaBanner.vue').default);

Vue.component('Clasesmallbox', require('./components/Clase/ClaseSmallBox.vue').default);
Vue.component('Editclase', require('./components/Clase/EditClase.vue').default);
Vue.component('Claseview', require('./components/Clase/ClaseView.vue').default);

Vue.component('Addentrenador', require('./components/Entrenador/AddEntrenador.vue').default);
Vue.component('Editentrenador', require('./components/Entrenador/EditEntrenador.vue').default);
Vue.component('Entrenador', require('./components/Entrenador/Entrenador.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
