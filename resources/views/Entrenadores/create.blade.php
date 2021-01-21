@extends('layouts.app')

@section('content')

  <div class="full-height container mt-4">

      <a class="back-icon" href="/admin/settings/show-entrenador"><i class="fas fa-arrow-left"></i></a>

      <AddEntrenador :token="{{ json_encode(Auth::user()->api_token) }}"></AddEntrenador>

  </div>

@stop
