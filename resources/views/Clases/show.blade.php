@extends('layouts.app')

@section('content')

    <div class="pt-4">
        @php
            $isAdmin = Auth::user()->isAdmin ? "true" : "false";
            $pack = App\Models\Clase::findOrFail($clase->id)->group->pack
        @endphp

        @if ($isAdmin == "true")
            <a class="back-icon" href="/admin/settings/show-pack/{{ $pack->name }}/tag/{{ $pack->id }}"><i class="fas fa-arrow-left"></i></a>
        @else
            <a class="back-icon" href="/my-pack/{{ $pack->name }}/tag/{{ $pack->id }}"><i class="fas fa-arrow-left"></i></a>
        @endif
        <div class="pl-5">
            <Claseview :data="{{json_encode($clase) }}" :admin="{{$isAdmin}}"></Claseview> 
        </div>
    </div>
@stop
