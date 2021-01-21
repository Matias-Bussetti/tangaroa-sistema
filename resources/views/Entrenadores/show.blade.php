@extends('layouts.app')

@section('content')

<div class="full-height container">

    <div class="entrenador-container">
        @foreach ($entrenadores as $entrenador)
            <Entrenador :data="{{json_encode($entrenador) }}" :admin="true"></Entrenador>
        @endforeach
    </div>
    
</div>

    @stop

    