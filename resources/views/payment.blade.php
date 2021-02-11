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
                <!-- ARTICULOS -->
                <div class="container">
                    <h3>Va a comprar los siguientes artículos:</h3>
                    <table class="table table-striped">
                        <thead class="text-center">
                            <th>IMAGEN</th>
                            <th>NOMBRE</th>
                            <th>PRECIO SIN IVA</th>
                            <th>IVA</th>
                            <th>PRECIO CON IVA</th>
                            <th>CANTIDAD</th>
                        </thead>
                        <tbody class="text-center align-items-middle">
                            @foreach (Cart::getContent()->sortBy('name') as $item)
                                <tr>
                                    <td class="align-middle"><img src="{{ asset('img/product/' . $item->attributes->image) }}"
                                            class="img-thumbnail" style="max-width:50px; max-height:50px"></td>
                                    <td class="align-middle">{{ $item->name }}</td>
                                    <td class="align-middle">{{ $item->attributes->priceWithoutVAT }}€</td>
                                    <td class="align-middle">{{ $item->attributes->vat }}
                                        ({{ $item->attributes->vatPercent }}%)</td>
                                    <td class="align-middle">{{ $item->price }}€</td>
                                    <td class="align-middle">{{ $item->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- DIRECCION -->
                <div class="container mt-5">
                    <h3>Su pedido se enviará a la siguiente dirección:</h3>
                    <h4>Nombre: {{ session('address.name') }} {{ session('address.surname') }}</h4>
                    <h4>Dirección: {{ session('address.direccion') }}</h4>
                    <h4>{{ session('address.cp') }} {{ session('address.poblacion') }}
                        ({{ session('address.provincia') }})
                    </h4>
                </div>
                <!-- PAGO -->
                <div class="container mt-5">
                    <h3 class="display-5 text-center">
                        Continuar y pagar la cantidad de:
                    </h3>
                    <h2>{{ Cart::getTotal() }}€</h2>
                    <div class="container mt-4 text-center">
                        <a href="{{ route('make.payment') }}" class="btn btn-primary">
                            <img src="{{ asset('img/paypal_pagar.png') }}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
