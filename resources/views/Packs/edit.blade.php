@extends('layouts.app')

@section('content')
  <div class="full-height container" style="margin-top: 10px;margin-bottom:40px;">
    
    <a href="{{ str_replace(url('/'), '', url()->previous())}}"><i class="fas fa-arrow-left"></i></a>
    <EditPack :id="{{ $id }}" :token="{{ json_encode(Auth::user()->api_token) }}"></EditPack>

</div>
@stop