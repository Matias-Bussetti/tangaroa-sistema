@extends('layouts.app')

@section('content')

<div class="full-height container" style="margin-top: 10px;margin-bottom:40px;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2">
        <a class="navbar-brand" href="/admin/settings">Administrador</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/settings">Paquetes<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/admin/settings/show-entrenador">Entrenadores</a>
                </li>
            </ul>
        </div>
    </nav>

    <a href="/admin/settings/"><i class="fas fa-arrow-left"></i></a>

    @foreach ($entrenadores as $entrenador)
        <Entrenador :data="{{json_encode($entrenador) }}"></Entrenador>
    @endforeach

</div>

@stop
