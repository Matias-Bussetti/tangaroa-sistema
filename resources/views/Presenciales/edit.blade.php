@extends('layouts.app')

@section('content')

  <div class="full-height container">

      @php
       $pack = App\Models\Presencial::find($id)->get();
      @endphp

      <EditPresencial :id="{{ $id }}" :token="{{ json_encode(Auth::user()->api_token) }}"></EditPresencial>

  </div>

@stop
