@extends('layouts.app')

@section('content')

<div class="full-height container" style="margin-top: 10px;margin-bottom:40px;">

    {{--<Packsemanas 
        :pack-data="{{ json_encode($pack) }}"
    :semana-data="{{ json_encode($pack->semanas->map(function ($item, $key) {return ["id" => $item->id, "name" => $item->name, "color" => $item->color, "clases" => $item->clases];})) }}"
    :token="{{ json_encode(Auth::user()->api_token) }}">a
    </Packsemanas>--}}

    @foreach ($pack->semanas as $semana)

        <Semanabanner :data="{{json_encode($semana) }}" :token="{{ json_encode(Auth::user()->api_token) }}">
            
            @foreach ($semana->clases as $clase)

                <Clasesmallbox :data="{{json_encode($clase) }}"></Clasesmallbox>
                
            @endforeach

        </Semanabanner>

    @endforeach


</div>

@stop
