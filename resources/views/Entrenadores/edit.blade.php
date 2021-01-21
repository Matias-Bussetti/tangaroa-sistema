@extends('layouts.app')

@section('content')

  <div class="full-height container mt-4">

      <a class="back-icon" href="/admin/settings/show-entrenador"><i class="fas fa-arrow-left"></i></a>
  
      <EditEntrenador :user-id="{{$user->id}}" :entrenador-id="{{$user->entrenador->id}}" :token="{{ json_encode(Auth::user()->api_token) }}"></EditEntrenador>

  </div>

@stop
