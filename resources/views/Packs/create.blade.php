@extends('layouts.app')

@section('content')

  <div class="full-height container mt-4">

      <a class="back-icon" href="/admin/settings/"><i class="fas fa-arrow-left"></i></a>

      <AddPack :token="{{ json_encode(Auth::user()->api_token) }}"></AddPack>

  </div>

@stop
