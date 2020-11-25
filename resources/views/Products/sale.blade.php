@extends('layouts.app')

@section('content')

<div class="full-height container" style="margin-top: 10px;margin-bottom:40px;">

    @php
        $isAdmin = Auth::user()->isAdmin ? "true" : "false";
        $packs = App\Models\Pack::all()->diff(Auth::user()->userPacks->map(function ($item, $key){
            return $item->pack;
        }));
    @endphp

    @if ($isAdmin == "true")
        <a href="/admin/settings/"><i class="fas fa-arrow-left"></i></a>
    @else
        <a href="/home"><i class="fas fa-arrow-left"></i></a>
    @endif

    @foreach ($packs as $pack)
        <PackSale :data="{{json_encode($pack) }}" :admin="{{$isAdmin}}">

        </PackSale> 
    @endforeach
    

</div>

@stop
