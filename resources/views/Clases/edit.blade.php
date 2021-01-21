@extends('layouts.app')

@section('content')
  <div class="full-height container mt-4">
    
    <a class="back-icon" href="{{ str_replace(url('/'), '', url()->previous())}}"><i class="fas fa-arrow-left"></i></a>

    <EditClase :data="{{ json_encode($clase) }}" :pack-id="{{$clase->group->pack->id}}" :token="{{ json_encode(Auth::user()->api_token) }}"></EditClase>
    
  </div>
@stop
