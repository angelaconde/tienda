@extends('layouts.app')

@section('content')
    @guest
        <div class="container text-center">
            <div class="jumbotron m-2">
                <h2 class="display-5 text-center">Necesita registrarse para continuar el pedido.</h2>
                <br>
                <h3>¿Aún no está registrado? Haga click aquí:
                    <a href="{{ route('register') }}">Registrarse</a>
                </h3>
                <h3>¿Ya tiene una cuenta? Haga click aquí:
                    <a href="{{ route('login') }}">Acceder</a>
                </h3>
            </div>
        </div>


    @endguest
    @auth
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Dirección de envío') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('address') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="surname"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                                    <div class="col-md-6">
                                        <input id="surname" type="text"
                                            class="form-control @error('surname') is-invalid @enderror" name="surname"
                                            value="{{ old('surname') }}" required autocomplete="surname">

                                        @error('surname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="telefono"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>

                                    <div class="col-md-6">
                                        <input id="telefono" type="tel"
                                            class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                                            value="{{ old('telefono') }}" required autocomplete="telefono">

                                        @error('telefono')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="direccion"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>

                                    <div class="col-md-6">
                                        <input id="direccion" type="text"
                                            class="form-control @error('direccion') is-invalid @enderror" name="direccion"
                                            value="{{ old('direccion') }}" required autocomplete="direccion">

                                        @error('direccion')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cp" class="col-md-4 col-form-label text-md-right">{{ __('CP') }}</label>

                                    <div class="col-md-6">
                                        <input id="cp" type="text" class="form-control @error('cp') is-invalid @enderror"
                                            name="cp" value="{{ old('cp') }}" required autocomplete="cp">

                                        @error('cp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="poblacion"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Población') }}</label>

                                    <div class="col-md-6">
                                        <input id="poblacion" type="text"
                                            class="form-control @error('poblacion') is-invalid @enderror" name="poblacion"
                                            value="{{ old('poblacion') }}" required autocomplete="poblacion">

                                        @error('poblacion')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="provincia"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Provincia') }}</label>

                                    <div class="col-md-6">
                                        <input id="provincia" type="text"
                                            class="form-control @error('provincia') is-invalid @enderror" name="provincia"
                                            value="{{ old('provincia') }}" required autocomplete="provincia">

                                        @error('provincia')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Continuar al pago') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
