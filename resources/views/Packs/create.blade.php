@extends('layouts.app')

@section('content')

  <div class="full-height container" style="margin-top: 10px;margin-bottom:40px;">

      <a class="back-icon" href="/admin/settings/"><i class="fas fa-arrow-left"></i></a>

      <AddPack :token="{{ json_encode(Auth::user()->api_token) }}"></AddPack>

  </div>

@stop
