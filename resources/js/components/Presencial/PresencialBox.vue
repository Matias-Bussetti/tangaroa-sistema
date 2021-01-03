<template>
    <div class="presenciales-box">
        
        <h4>{{data.name}}</h4>
        
        <div class="has-link">
            <span v-if="admin && (faltante != 'Clase Finalizada')" :class="hasLink ? 'text-success' : 'text-danger' ">{{ hasLink ? "Tiene Link" : "No tiene Link" }}</span>
        </div>

        <p>{{ faltante }}</p>

        <a :href="href" v-if="empezo" :class="btnClass">{{ btnMsg }}</a>

        <a class="edit-icon" v-if="admin" :href="'/admin/settings/edit-presencial/' + data.id">
            <i id="editIcon" style="margin: auto;" class="fa fa-pencil" aria-hidden="true"></i>
        </a>

    </div>
</template>
<script>
    export default {
        props: ['data', 'admin'],

        data() {
            return {
                href: '#',
                faltante: '',
                empezo: false,
                hasLink: false,
                btnClass: 'btn btn-success',
                btnMsg: 'Acceder a mi Clase',
            }
        },


        created() {
            this.countDownTimer()
            if (this.faltante != 'Clase Finalizada') {
                this.checkLink()
            }
        },

        methods: {

            countDownTimer() {

                if (this.data.fecha == this.formatDate(new Date())) {

                    if (new Date().getHours() <= parseInt(this.data.hora_fin.slice(0, 2), 10) && new Date().getHours() >= parseInt(this.data.hora_inicio.slice(0, 2), 10)) {

                        setTimeout(() => {

                            if (new Date(this.data.fecha + " " + this.data.hora_inicio).getTime() < new Date().getTime() && new Date().getTime() < new Date(this.data.fecha + " " + this.data.hora_fin).getTime()) {

                                console.log("empezo tu clase: " + this.data.name)
                                this.empezo = true;
                                this.faltante = "En curso"
                                this.fetchLink()

                            } else {

                                this.empezo = false;

                                if (new Date().getTime() > new Date(this.data.fecha + " " + this.data.hora_fin).getTime()) {

                                    this.faltante = "Clase Finalizada"

                                } else {

                                    this.countDownTimer()

                                }


                            }

                        }, 1000)

                    }

                }

            },

            formatDate(date) {
                return new Date(date).getFullYear().toString() + "-" + (new Date(date).getMonth() < 10 ? "0" : "") + (new Date(date).getMonth() + 1).toString() + "-" + (new Date(date).getDate() < 10 ? "0" : "") + new Date(date).getDate().toString();
            },

            async fetchLink() {

                fetch(`/api/presencial/link/${this.data.id}`, {
                    headers: {
                        "Authorization": `Bearer ${this.token}`,
                    },
                    method: 'GET',
                }).then(res => res.json()).then(res => {

                    //this.presenciales = res.data;
                    console.log(res.data);
                    this.href = res.data;

                }).catch(err => {
                    this.btnMsg = "Intente denuevo"
                    this.btnClass = "btn btn-warning"
                });

            },

            async checkLink() {

                var weekday = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domigo"];

                if (this.data.fecha == this.formatDate(new Date())) {

                    this.faltante = "Hoy a las " + this.data.hora_inicio.slice(0, 5)

                    if (this.admin && new Date(this.data.fecha + " " + this.data.hora_fin).getTime() > new Date().getTime()) {

                    fetch(`/api/presencial/link/${this.data.id}`, {
                        headers: {
                            "Authorization": `Bearer ${this.token}`,
                        },
                        method: 'GET',
                    }).then(res => res.json()).then(res => {

                        this.hasLink = true;

                    }).catch(err => {

                        this.hasLink = false
                        
                    });

                    }
                    //AGREGAR UN METODO QUE SE FIJE SIN MANDAR EL LINK SI LO TIENE SINO HASLINK = TRUE

                    if (new Date(this.data.fecha + " " + this.data.hora_inicio).getTime() < new Date().getTime() && new Date().getTime() < new Date(this.data.fecha + " " + this.data.hora_fin).getTime()) {

                        this.faltante = "En curso"

                    }

                } else {

                    this.faltante = "Proximo " + weekday[new Date(this.data.fecha).getDay()]

                }

            },



        },

        computed: {

        },

    }
</script>