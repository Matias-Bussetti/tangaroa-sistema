@extends('layouts.app')

@section('content')

  <div class="full-height container" style="margin-top: 10px;margin-bottom:40px;">

      @php
          $pack = App\Models\Pack::findorFail($id);
      @endphp

      <a class="back-icon" href="/admin/settings/show-pack/{{$pack->name}}/tag/{{$pack->id}}"><i class="fas fa-arrow-left"></i></a>

      <EditPack :id="{{ $id }}" :token="{{ json_encode(Auth::user()->api_token) }}"></EditPack>

  </div>

@stop
