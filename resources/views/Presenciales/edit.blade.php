@extends('layouts.app')

@section('content')

  <div class="full-height container" style="margin-top: 10px;margin-bottom:40px;height: 75vh;"> <!-- ANCHOR - Cambiar inline-style -->

      @php
       $pack = App\Models\Presencial::find($id)->get();
      @endphp

      <EditPresencial :id="{{ $id }}" :token="{{ json_encode(Auth::user()->api_token) }}"></EditPresencial>

  </div>

@stop
