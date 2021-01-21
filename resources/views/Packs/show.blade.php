@extends('layouts.app')

@section('content')


@php
    $isAdmin = Auth::user()->isAdmin ? "true" : "false";
    $clase_done =
    App\Models\User_Clase::select('clase_id')->where('user_id',Auth::user()->id)->where('pack_id',$pack->id)->get()->map(function
    ($item, $key) {
    return $item->clase_id;
    });
    $clase_done = $clase_done->toArray();
@endphp
<div>

@if ($isAdmin == "true")
    <a class="back-icon" href="/admin/settings/"><i class="fas fa-arrow-left"></i></a>
@else
    <a class="back-icon" href="/home"><i class="fas fa-arrow-left"></i></a>
@endif

@switch($pack->type)
    @case(0)
    <Packbanner :data="{{json_encode($pack) }}" :admin="{{$isAdmin}}">
        
        {{-- <Progreso :id="{{$pack->id}}" :user-id="{{ Auth::user()->id }}" :token="{{ json_encode(Auth::user()->api_token) }}"></Progreso> --}}
        
            @foreach ($pack->semanas as $semana)

            <Semanabanner :data="{{json_encode($semana) }}" :token="{{ json_encode(Auth::user()->api_token) }}"
                :count="{{count($semana->clases)}}" :admin="{{$isAdmin}}">

                @foreach ($semana->clases as $clase)

                {{-- <a class="nodecoration" style="text-decoration:none;" href="'/my-workout/' + {{$clase->name}} + '/tag/' +
                {{$clase->id}}"> --}}

                <Clasesmallbox :data="{{json_encode($clase) }}"
                    :done="{{ in_array(strval($clase->id),$clase_done) ? "true" : "false"}}" :admin="{{$isAdmin}}"
                    :index="{{ $loop->index + 1 }}"></Clasesmallbox>

                {{-- </a> --}}

                @endforeach

            </Semanabanner>

            @endforeach

        </Packbanner>

    @break

    @case(1)

        <PresencialContainer :pack="{{ json_encode($pack) }}" :token="{{ json_encode(Auth::user()->api_token) }}" :admin="{{$isAdmin}}" />

    @break

@default

@endswitch
</div>


@stop
