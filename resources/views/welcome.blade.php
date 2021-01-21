@extends('layouts.app')

@section('content')

    <!-- TODO[epic-html] asd -->

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

    <div class="carousel-inner">

        <div class="carousel-item active">
            <img class="d-block w-100 h-100" src="/img/page/welcome-image.png" alt="First slide">
        </div>

        <div class="carousel-item">
            <img class="d-block w-100 h-100" src="/img/page/welcome-image.png" alt="Third slide">
        </div>

    </div>

    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</div>


<section>

    <h3 class="title" style="">Somos Tangaroa Entrenamiento</h3>

    <p>
        ¡Subí tu nivel, estés donde estés! Nuestros programas están diseñados para aquellos que se comprometen con
        el
        entrenamiento y la salud. Para aquellos que realmente quieren un cambio. Si te sentís identificado, sumate a
        la
        tribu.
    </p>


</section>

<hr>

<section>

    @php
    $entrenadores = App\User::where('isAdmin',1)->with('entrenador')->get();
    $entrenadores = $entrenadores->whereNotNull('entrenador');
    @endphp

    <h3 class="title">Quiénes somos</h3>

    <div class="entrenador-container">
        @foreach ($entrenadores as $entrenador)
        <Entrenador :data="{{json_encode($entrenador) }}" :admin="false"></Entrenador>
        @endforeach
    </div>

</section>


<hr>

<section>

    <h3 style="color: black" class="title">Nuestros Productos</h3>

    <div style="background-color: black">

        @php
        $packs_grabados = App\Models\Pack::where('type',0)->get();
        $packs_presenciales = App\Models\Pack::where('type',2)->get();
        @endphp

        @if (!($packs_grabados == "[]"))

            <h4 style="color: whitesmoke" class="title">Cursos Online</h4>

            <div id="container-grabadas" class="container-box">

                @foreach ($packs_grabados as $pack)

                @if ($loop->last)
                <Packbox id="comodin-grabada-front" class="comodin" :data="{{ json_encode($pack) }}" :admin="false"
                    :fill="true"></Packbox>
                @endif

                <Packbox :data="{{ json_encode($pack) }}" :admin="false" :fill="false"></Packbox>

                @if ($loop->last)
                <Packbox id="comodin-grabada-back" class="comodin" :data="{{ json_encode($pack) }}" :admin="false"
                    :fill="true"></Packbox>
                @endif

                @endforeach
                <Packbox :data="{{ json_encode($pack) }}" :admin="false" :fill="false"></Packbox>

            </div>

        @endif

        <br>

        @if (!($packs_presenciales == "[]"))

            <h4 style="color: whitesmoke" class="title">Presenciales</h4>

            <br>

            <div id="container-presenciales" class="container-box">


                @foreach ($packs_presenciales as $pack)

                    @if ($loop->last)
                    <Packbox id="comodin-presencial-front" class="comodin" :data="{{ json_encode($pack) }}" :admin="false"
                        :fill="true"></Packbox>
                    @endif

                    <Packbox :data="{{ json_encode($pack) }}" :admin="false" :fill="false"></Packbox>

                    @if ($loop->last)
                    <Packbox id="comodin-presencial-back" class="comodin" :data="{{ json_encode($pack) }}" :admin="false"
                        :fill="true"></Packbox>
                    @endif

                @endforeach

            </div>

            <br>

            @endif

    </div>

</section>


<section>

    <h3 class="title">Asesorías Online</h3>

    <p style=" text-align: center; padding: 10px 30%;">
        No importa en qué lugar del mundo te encuentres, podés acceder a nuestros entrenamientos. Nos centramos en
        tus
        objetivos personales, buscando la mejor calidad técnica y apuntando a la salud del movimiento, ¡Escribinos!
    </p>

    <div style="width: fit-content; margin: auto;">
        <a class="btn btn-success" href="https://api.whatsapp.com/send/?phone=542915276792">
            <i class="fab fa-whatsapp"></i> ¡Quiero entrenar con ustedes!
        </a>
    </div>

</section>

<hr>

<section>

    <h3 class="title">¡Sigamos conectados!</h3>

    <div class="contact-icons-container">

        <a class="icon instagram" href="https://www.instagram.com/tangaroa.entrenamiento/" target="_blank"
            rel="noopener noreferrer">
            <i class="fab fa-instagram"></i>
        </a>

        <a class="icon facebook" href="https://www.facebook.com/TangaroaEntrenamiento/" target="_blank"
            rel="noopener noreferrer">
            <i class="fab fa-facebook-f"></i>
        </a>

        <a class="icon youtube" href="https://www.youtube.com/channel/UCa_v3ngdMRDuB1-kdtRWx9Q" target="_blank"
            rel="noopener noreferrer">
            <i class="fab fa-youtube"></i>
        </a>

    </div>
</section>


@stop
