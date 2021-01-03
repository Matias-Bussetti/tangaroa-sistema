@extends('layouts.app')

@section('content')

<div class="auth-bg">

    <div class="container">

        <div class="row justify-content-center">

            <div class="auth-container mt-4">

                <form class="auth-form" method="POST" action="{{ route('register') }}">
                    @csrf

                    <h3 class="title">Registrarme</h3>

                    <input id="name" type="text" class="input @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus
                        placeholder="Nombre y Apellido">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input id="password" type="password" class="input @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password" placeholder="Contraseña">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <input id="password-confirm" type="password" class="input" name="password_confirmation" required
                        autocomplete="new-password" placeholder="Confirmación">

                    <button type="submit" class="btn btn-warning w-100 submit">
                        {{ __('Registrarme') }}
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
