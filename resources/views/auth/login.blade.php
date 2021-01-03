@extends('layouts.app')

@section('content')

<div class="auth-bg">

    <div class="container">

        <div class="row justify-content-center">

            <div class="auth-container mt-4">
                
                <form class="auth-form" method="POST" action="{{ route('login') }}">
                    @csrf   

                    <h3 class="title">Ingresar</h3>
                    
                    <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus  placeholder="Email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
                    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                    <div class="form-group row f-left">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            
                                <label class="form-check-label" for="remember">
                                    {{ __('Recuerdame') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 submit">
                        {{ __('Ingresar') }}
                    </button>

                </form>
                
            </div>

        </div>

    </div>

</div>
@endsection
