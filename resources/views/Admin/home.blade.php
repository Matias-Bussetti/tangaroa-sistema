@extends('layouts.app')

@section('content')

<div class="container">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2">

        <a class="navbar-brand" href="/admin/settings">Administrador</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/admin/settings">Paquetes<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/settings/show-entrenador">Entrenadores</a>
                </li>
                <!-- 
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                -->
            </ul>
        </div>
    </nav>
        {{-- <div class="pack "
            style="background: linear-gradient(180deg, rgba(0,0,0,1) 9%, rgba(0,0,0,0.9164040616246498) 15%, rgba(0,212,255,0) 100%);display:inline-box;">
            <a href="/admin/settings/create-pack"><i class="fas fa-plus"></i></a>
        </div>--}}
    <div class="scroll-x">

        
        

        
        @foreach (App\Models\Pack::all() as $pack)
        
            <PackPortrait :data="{{ json_encode($pack) }}" :admin="true"></PackPortrait>
        
        @endforeach

    </div>

</div>

@endsection