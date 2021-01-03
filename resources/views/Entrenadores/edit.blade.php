@extends('layouts.app')

@section('content')

  <div class="full-height container" style="margin-top: 10px;margin-bottom:40px; height: 100vh"> <!-- ANCHOR - Cambiar inline-style -->

      <a class="back-icon" href="/admin/settings/show-entrenador"><i class="fas fa-arrow-left"></i></a>
  
      <EditEntrenador :user-id="{{$user->id}}" :entrenador-id="{{$user->entrenador->id}}" :token="{{ json_encode(Auth::user()->api_token) }}"></EditEntrenador>

  </div>

@stop
