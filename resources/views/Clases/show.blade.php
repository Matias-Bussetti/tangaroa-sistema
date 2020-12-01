@extends('layouts.app')

@section('content')


    @php
        $isAdmin = Auth::user()->isAdmin ? "true" : "false";
        $pack = App\Models\Clase::findOrFail($clase->id)->group->pack
    @endphp

    @if ($isAdmin == "true")
        <a href="/admin/settings/show-pack/{{ $pack->name }}/tag/{{ $pack->id }}"><i class="fas fa-arrow-left"></i></a>
    @else
        <a href="/my-pack/{{ $pack->name }}/tag/{{ $pack->id }}"><i class="fas fa-arrow-left"></i></a>
    @endif

    <Claseview :data="{{json_encode($clase) }}" :admin="{{$isAdmin}}"></Claseview> 

@stop
