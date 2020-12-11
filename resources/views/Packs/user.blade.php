@extends('layouts.app')

@section('content')


    
    <a class="back-icon" href="/home"><i class="fas fa-arrow-left"></i></a>

    <Packbanner :data="{{json_encode($pack) }}" :admin="false">

        @foreach ($pack->semanas as $semana)

            <Semanabanner :data="{{json_encode($semana) }}" :token="{{ json_encode(Auth::user()->api_token) }}" :count="1" :admin="false">

                @foreach ($semana->clases as $clase)

                    <Clasesmallbox :data="{{json_encode($clase) }}" :admin="false"></Clasesmallbox>
                    
                @endforeach

            </Semanabanner>

        @endforeach

    </Packbanner>


@stop
