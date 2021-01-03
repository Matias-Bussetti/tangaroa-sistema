@extends('layouts.app')

@section('content')

<div class="full-height container" style="margin-top: 10px;margin-bottom:40px;height: 75vh"> <!-- ANCHOR - Cambiar inline-style -->
    <div class="scroll-x">
        <div class="entrenador-container">
            @foreach ($entrenadores as $entrenador)
                <Entrenador :data="{{json_encode($entrenador) }}"></Entrenador>
            @endforeach
        </div>
    </div>
    
</div>

    @stop

    