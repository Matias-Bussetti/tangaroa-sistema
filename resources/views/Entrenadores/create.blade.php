@extends('layouts.app')

@section('content')

  <div class="full-height container" style="margin-top: 10px;margin-bottom:40px;height: 75vh;"> <!-- ANCHOR - Cambiar inline-style -->

      <a class="back-icon" href="/admin/settings/show-entrenador"><i class="fas fa-arrow-left"></i></a>

      <AddEntrenador :token="{{ json_encode(Auth::user()->api_token) }}"></AddEntrenador>

  </div>

@stop
