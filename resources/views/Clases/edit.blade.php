@extends('layouts.app')

@section('content')
  <div class="full-height container" style="margin-top: 10px;margin-bottom:40px;">

  <EditClase :data="{{ json_encode($clase) }}" :token="{{ json_encode(Auth::user()->api_token) }}"></EditClase>
    {{ $clase }}

    

</div>
@stop
