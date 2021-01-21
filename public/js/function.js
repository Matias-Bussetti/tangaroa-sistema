window.addEventListener('load', function () {
/*
var container_grabadas = document.getElementById("container-grabadas");
var container_presenciales = document.getElementById("container-presenciales");

var comodin_grabada_front = document.getElementById("comodin-grabada-front");
var comodin_grabada_back = document.getElementById("comodin-grabada-back");

var comodin_presencial_front = document.getElementById("comodin-presencial-front");
var comodin_presencial_back = document.getElementById("comodin-presencial-back");

function outputsize() {
    console.warn("resized");
   // textFit(document.querySelector(".container-name"));
  
    comodin_grabada_front.style.display = "none";
    comodin_grabada_back.style.display = "none";
    comodin_presencial_front.style.display = "none";
    comodin_presencial_back.style.display = "none";
   
    if(container_grabadas.offsetWidth > 1600 && (container_grabadas.childElementCount - 2) > 3) {

        console.log("En container-grabadas una resolucion mas grande que 1600px: ");
        if((container_grabadas.childElementCount - 2) % 3 === 0){
            console.log(" ---> No sobran children con 33.3%");
        }
        if((container_grabadas.childElementCount - 2) % 3 === 1){
            console.log(" ---> Sobra un children con 33.3%");
            comodin_presencial_back.style.display = "block";
            comodin_grabada_back.style.display = "block";
        }
        if((container_grabadas.childElementCount - 2) % 3 === 2){
            console.log(" ---> Sobran 2 children con 33.3%");
            comodin_grabada_front.style.display = "block";
        }
    }
    
    console.log((container_presenciales.childElementCount - 2 ) % 3 === 0);

    if(container_presenciales.offsetWidth > 1600 && (container_presenciales.childElementCount - 2) > 3) {

        console.log("En container-presenciales una resolucion mas grande que 1600px: ");

        if((container_presenciales.childElementCount - 2) % 3 === 0){
            console.log(" ---> No sobran children con 33.3%");
        }

        if((container_presenciales.childElementCount - 2) % 3 === 1){
            console.log(" ---> Sobra un children con 33.3%");

            comodin_presencial_front.style.display = "block";
            comodin_presencial_back.style.display = "block";
        }

        if((container_presenciales.childElementCount - 2) % 3 === 2){
            console.log(" ---> Sobran 2 children con 33.3%");
            comodin_presencial_front.style.display = "block";
        }
    }
    
    if( 800 < container_presenciales.offsetWidth && container_presenciales.offsetWidth < 1600 && (container_grabadas.childElementCount - 2) > 2) {

        console.log("En container-grabadas una resolucion mas grande que 1600px: ");
        if(container_grabadas.childElementCount % 2 === 0){
            console.log(" ---> No sobran children con 50%");
        }
        if(container_grabadas.childElementCount % 2 === 1){
            console.log(" ---> Sobra un children con 50%");
            if(Math.random() < 0.5){
                comodin_grabada_front.style.display = "block";
            } else {
                comodin_grabada_back.style.display = "block";
            }
        }
    }
    
    
    if( 800 < container_presenciales.offsetWidth && container_presenciales.offsetWidth < 1600 && (container_presenciales.childElementCount - 2) > 2) {

        console.log("En container-presenciales una resolucion mas grande que 1600px: ");
        if(container_presenciales.childElementCount % 2 === 0){
            console.log(" ---> No sobran children con 50%");
        }
        if(container_presenciales.childElementCount % 2 === 1){
            console.log(" ---> Sobra un children con 50%");
            if(Math.random() < 0.5){
                comodin_presencial_front.style.display = "block";
            } else {
                comodin_presencial_back.style.display = "block";
            }
        }
    }

    if (container_presenciales.offsetWidth < 800) {

        

    }

}
outputsize()

new ResizeObserver(outputsize).observe(document.querySelector(".container-name"))


console.log(document.querySelector(".container-name"));
/*textFit(document.querySelector(".container-name"));
textFit(document.querySelector(".container-subname"));
*/

})


// TODO Separar en 2 funciones segun el contenedor y llamar a las funciones en vez que todo junto ya que si no exite un contenedor en especial no funciona