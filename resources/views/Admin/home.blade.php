@extends('layouts.app')

@section('content')



<div class="container">

    
        {{-- <div class="pack "
            style="background: linear-gradient(180deg, rgba(0,0,0,1) 9%, rgba(0,0,0,0.9164040616246498) 15%, rgba(0,212,255,0) 100%);display:inline-box;">
            <a href="/admin/settings/create-pack"><i class="fas fa-plus"></i></a>
        </div>--}}
    

    <div class="scroll-x">
        
        @foreach (App\Models\Pack::orderBy('type','desc')->get() as $pack)
        
            <PackPortrait :data="{{ json_encode($pack) }}" :admin="true"></PackPortrait>
        
        @endforeach

    </div>

</div>

@endsection