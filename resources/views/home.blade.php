@extends('layouts.app')

@section('content')

<div class="container">

    
    @if (isset($status))
    {{$status}}
    @endif
    
    @php
        
        $isAdmin = Auth::user()->isAdmin == 1 ? "true" : "false";
        
        $ahora = Carbon\Carbon::now()->hour;
        
        $welcome_msg = "";
        
        if (6 < $ahora && $ahora <= 12) {
            $welcome_msg = "Buenos Días";
        }
        
        if (12 < $ahora && $ahora <= 19) {
            $welcome_msg = "Buenas Tardes";
        }
        
        if (19 < $ahora || $ahora <= 6) {
            $welcome_msg = "Buenas Noches";
        }
        
        $welcome_msg .= ", " . Auth::user()->name;
        
        
        @endphp
        {{--
            <div class="pack ml-2 mr-2" style="background: linear-gradient(180deg, rgba(0,0,0,1) 9%, rgba(0,0,0,0.9164040616246498) 15%, rgba(0,212,255,0) 100%), url('/img/page/300x800.png')">
                <a href="/sale"><h4 class="title">Comprar</h4></a>
            </div>--}}
            
            <h1 class="user-title text-lg-left pt-2">{{$welcome_msg}}</h1>
            <div class="row justify-content-center">

        <div class="scroll-x">
        
            @foreach ($packs as $pack)

                <PackPortrait :data="{{ json_encode($pack) }}" :admin="{{$isAdmin}}"></PackPortrait>

            @endforeach
        
        </div>

    </div>

</div>

@endsection
