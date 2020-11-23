@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="pack ml-2 mr-2" style="background: linear-gradient(180deg, rgba(0,0,0,1) 9%, rgba(0,0,0,0.9164040616246498) 15%, rgba(0,212,255,0) 100%);">
            <a href="create-pack"><i class="fas fa-plus"></i></a>
        </div>
        
        @foreach (App\Models\Pack::all() as $pack)
        
            <PackPortrait :data="{{ json_encode($pack) }}" :admin="true"></PackPortrait>
            
        
        @endforeach

    </div>
    
</div>

@endsection