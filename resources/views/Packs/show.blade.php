@extends('layouts.app')

@section('content')


    @php
        $isAdmin = Auth::user()->isAdmin ? "true" : "false";
    @endphp

    @if ($isAdmin == "true")
        <a class="back-icon" href="/admin/settings/"><i class="fas fa-arrow-left"></i></a>
    @else
        <a class="back-icon" href="/home"><i class="fas fa-arrow-left"></i></a>
    @endif

    <Packbanner :data="{{json_encode($pack) }}" :admin="{{$isAdmin}}">

        @foreach ($pack->semanas as $semana)

          <Semanabanner :data="{{json_encode($semana) }}" :token="{{ json_encode(Auth::user()->api_token) }}" :count="{{count($semana->clases)}}" :admin="{{$isAdmin}}">
                  
                @foreach ($semana->clases as $clase)
        
                    {{-- <a class="nodecoration" style="text-decoration:none;" href="'/my-workout/' + {{$clase->name}} + '/tag/' + {{$clase->id}}"> --}}

                        <Clasesmallbox :data="{{json_encode($clase) }}" :admin="{{$isAdmin}}" :index="{{ $loop->index + 1 }}"></Clasesmallbox>
                       
                    {{-- </a> --}}
            
                @endforeach

            </Semanabanner>

        @endforeach

    </Packbanner> 


@stop
