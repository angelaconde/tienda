@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 bg-light">
                <!-- ALERTA DE STOCK -->
                @if (session('stock_alert'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('stock_alert') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- FIN DE ALERTA -->
                @if (count(Cart::getContent()))
                    <table class="table table-striped">
                        <thead class="text-center">
                            <th>IMAGEN</th>
                            <th>NOMBRE</th>
                            <th>PRECIO SIN IVA</th>
                            <th>IVA</th>
                            <th>PRECIO CON IVA</th>
                            <th>CANTIDAD</th>
                            <th>ELIMINAR</th>
                        </thead>
                        <tbody class="text-center align-items-middle">
                            @foreach (Cart::getContent()->sortBy('name') as $item)
                                <tr>
                                    <td class="align-middle"><img
                                            src="{{ asset('img/product/' . $item->attributes->image) }}"
                                            class="img-thumbnail" style="max-width:50px; max-height:50px"></td>
                                    <td class="align-middle">{{ $item->name }}</td>
                                    <td class="align-middle">{{ $item->attributes->priceWithoutVAT }}€</td>
                                    <td class="align-middle">{{ $item->attributes->vat }}
                                        ({{ $item->attributes->vatPercent }}%)</td>
                                    <td class="align-middle">{{ $item->price }}€</td>
                                    <td class="align-middle">
                                        {{-- Actualizar cantidad
                                        --}}
                                        <form action="{{ route('cart.update') }}" method="post">
                                            @csrf
                                            <div class="form-row align-items-middle justify-content-center">
                                                <div class="col">
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <input min="1" max="{{ $item->attributes->stock }}" id="cantidad"
                                                        name="cantidad"
                                                        value="{{ $item->quantity <= $item->attributes->stock ? $item->quantity : $item->attributes->stock }}"
                                                        type="number" class="form-control">
                                                </div>
                                                <div class="col-2">
                                                    <button type="submit" name="btn" class="btn btn-dark btn-sm"><i
                                                            class="fas fa-sync-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        {{-- Fin de actualizar cantidad
                                        --}}
                                    </td>
                                    <td class="align-middle">
                                        <form action="{{ route('cart.removeitem') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">X</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm">Vaciar carrito</button>
                            </form>
                        </div>
                        <div class="col text-right">
                            <h2 class="mt-1">Total: {{ Cart::getTotal() }}€</h2>
                            <form action="{{ route('order') }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-dark btn-lg mt-1">Realizar compra</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="container text-center">
                        <div class="jumbotron m-2">
                            <h1 class="display-5 text-center">Tu carrito está vacío.</h1>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
