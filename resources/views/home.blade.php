@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        @if (isset($status))
            {{$status}}
        @endif

        @php
            $isAdmin = Auth::user()->isAdmin == 1 ? "true" : "false";
        @endphp

        <div class="pack ml-2 mr-2" style="background: linear-gradient(180deg, rgba(0,0,0,1) 9%, rgba(0,0,0,0.9164040616246498) 15%, rgba(0,212,255,0) 100%), url('/img/page/300x800.png')">
            <a href="/sale"><h4 class="title">Comprar</h4></a>
        </div>

        @foreach ($packs as $pack)
        
            <PackPortrait :data="{{ json_encode($pack) }}" :admin="{{$isAdmin}}"></PackPortrait>
            
        @endforeach

    </div>
    
</div>

@endsection
