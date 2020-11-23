@extends('layouts.app')

@section('content')


    @php
        $isAdmin = Auth::user()->isAdmin ? "true" : "false";
    @endphp

    <Claseview :data="{{json_encode($clase) }}" :admin="{{$isAdmin}}"></Claseview> 


@stop
