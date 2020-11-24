@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        @if (isset($status))
            {{$status}}
        @endif

        @php
            $isAdmin = Auth::user()->isAdmin ? "true" : "false";
        @endphp

        @foreach ($packs as $pack)
        
            <PackPortrait :data="{{ json_encode($pack) }}" :admin="{{$isAdmin}}"></PackPortrait>
        
        @endforeach
    
    </div>
    
</div>

@endsection
