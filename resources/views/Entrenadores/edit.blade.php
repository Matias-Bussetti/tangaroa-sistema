@extends('layouts.app')

@section('content')

  <div class="full-height container" style="margin-top: 10px;margin-bottom:40px;">

      <a href="/admin/settings/"><i class="fas fa-arrow-left"></i></a>
  
      <EditEntrenador :user-id="{{$user->id}}" :entrenador-id="{{$user->entrenador->id}}" :token="{{ json_encode(Auth::user()->api_token) }}"></EditEntrenador>

  </div>

@stop