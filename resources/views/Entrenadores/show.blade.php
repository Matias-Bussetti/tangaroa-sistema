@extends('layouts.app')

@section('content')

<div class="full-height container" style="margin-top: 10px;margin-bottom:40px;">


    <a href="/admin/settings/"><i class="fas fa-arrow-left"></i></a>

    @foreach ($entrenadores as $entrenador)
        <Entrenador :data="{{json_encode($entrenador) }}"></Entrenador>
    @endforeach

</div>

@stop