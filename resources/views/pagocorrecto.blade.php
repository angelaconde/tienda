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
        <div class="container text-center">
            <div class="jumbotron m-2">
                <h2 class="display-5 text-center">Su pago ha sido recibido correctamente.</h2>
            </div>
        </div>
    @endauth
@endsection
