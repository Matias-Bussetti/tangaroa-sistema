@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <a href="{{ str_replace(url('/'), '', url()->previous())}}"><i class="fas fa-arrow-left"></i></a>
        <Packs :token="{{ json_encode(Auth::user()->api_token) }}"></Packs>
        
    </div>
    
</div>

@endsection