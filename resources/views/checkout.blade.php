@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 bg-light">
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
                            @foreach (Cart::getContent() as $item)
                                <tr>
                                    <td class="align-middle"><img src="{{ asset('img/product/' . $item->attributes->image) }}"
                                            class="img-thumbnail" style="max-width:50px; max-height:50px"></td>
                                    <td class="align-middle">{{ $item->name }}</td>
                                    <td class="align-middle">{{ $item->attributes->priceWithoutVAT }}€</td>
                                    <td class="align-middle">{{ $item->attributes->vat }} ({{ $item->attributes->vatPercent }}%)</td>
                                    <td class="align-middle">{{ $item->price }}€</td>
                                    <td class="align-middle">{{ $item->quantity }}</td>
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
                            <p>Subtotal: {{ Cart::getTotal() }}€</p>
                            <p>Envío: 5€</p>
                            <p>Total: {{ Cart::getTotal() + 5 }}€</p>
                            <form action="" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-dark btn-lg">Realizar compra</button>
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
