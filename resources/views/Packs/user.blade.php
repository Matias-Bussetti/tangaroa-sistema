@extends('layouts.app')

@section('content')

<div class="full-height container" style="margin-top: 10px;margin-bottom:40px;">
    
    <a href="/home"><i class="fas fa-arrow-left"></i></a>
    
    <Packbanner :data="{{json_encode($pack) }}" :admin="false">

        @foreach ($pack->semanas as $semana)

            <Semanabanner :data="{{json_encode($semana) }}" :token="{{ json_encode(Auth::user()->api_token) }}" :admin="false">
                
                @foreach ($semana->clases as $clase)

                    <Clasesmallbox :data="{{json_encode($clase) }}" :admin="false"></Clasesmallbox>
                    
                @endforeach

            </Semanabanner>

        @endforeach

    </Packbanner>

</div>

@stop
