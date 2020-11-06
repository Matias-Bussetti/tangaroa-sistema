@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!--
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
              </div>
            </div>
        -->
        
        
    </div>
    
        <!-- <editPack :pack-id="1" :csrf-token="{{ json_encode(csrf_token()) }}"></editPack> -->
        
        <Packs></Packs>

        
    
</div>
@endsection
