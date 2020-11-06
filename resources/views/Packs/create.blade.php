@extends('layouts.app')

@section('content')
  <div class="full-height container" style="margin-top: 10px;margin-bottom:40px;">

    <AddPack :csrf-token="{{ json_encode(csrf_token()) }}"></AddPack>

</div>
@stop
