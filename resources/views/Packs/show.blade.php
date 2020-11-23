@extends('layouts.app')

@section('content')

<div class="full-height container" style="margin-top: 10px;margin-bottom:40px;">

    @php
        $isAdmin = Auth::user()->isAdmin ? "true" : "false";
    @endphp

    @if ($isAdmin == "true")
        <a href="/admin/settings/"><i class="fas fa-arrow-left"></i></a>
    @else
        <a href="/home"><i class="fas fa-arrow-left"></i></a>
    @endif


    <Packbanner :data="{{json_encode($pack) }}" :admin="{{$isAdmin}}">

        @foreach ($pack->semanas as $semana)

            <Semanabanner :data="{{json_encode($semana) }}" :token="{{ json_encode(Auth::user()->api_token) }}" :admin="{{$isAdmin}}">
                
                @foreach ($semana->clases as $clase)

                    <Clasesmallbox :data="{{json_encode($clase) }}" :admin="{{$isAdmin}}"></Clasesmallbox>
                    
                @endforeach

            </Semanabanner>

        @endforeach

    </Packbanner> 

</div>

@stop
