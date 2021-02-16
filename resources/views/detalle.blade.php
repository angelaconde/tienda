@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 bg-light">
                <div class="row">
                    <div class="container text-center">
                        <div class="jumbotron m-1 p-3">
                            <!-- ORDER INFO -->
                            <div class="row">
                                <div class="col">
                                    <h5>Número de pedido: {{ $order->id }}</h5>
                                </div>
                                <div class="col">
                                    <h5>Fecha: {{ date('d/m/Y G:i:s', strtotime($order->fecha)) }}</h5>
                                </div>
                                <div class="col">
                                    <h5>Estado:
                                        @switch($order->estado)
                                            @case('P')
                                            <span class="badge badge-secondary">Pendiente</span>
                                            @break
                                            @case('E')
                                            <span class="badge badge-primary">Enviado</span>
                                            @break
                                            @case('R')
                                            <span class="badge badge-success">Recibido</span>
                                            @break
                                            @case('C')
                                            <span class="badge badge-danger">Cancelado</span>
                                            @break
                                        @endswitch
                                    </h5>
                                </div>
                            </div>
                            <!-- CLIENT INFO -->
                            <div class="row p-4">
                                <div class="col">
                                    <h4>Nombre: {{ $order->name }} {{ $order->surname }}</h4>
                                    <h4>Dirección: {{ $order->direccion }}</h4>
                                    <h4>{{ $order->cp }} {{ $order->poblacion }} ({{ $order->provincia }})</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <table class="table table-striped">
                    <thead class="text-center">
                        <th>IMAGEN</th>
                        <th>NOMBRE</th>
                        <th>PRECIO</th>
                        <th>CANTIDAD</th>
                    </thead>
                    <tbody class="text-center align-items-middle">
                        @foreach ($items as $item)
                            <tr>
                                <td class="align-middle"><img src="{{ asset('img/product/' . $item->product->imagen) }}"
                                        class="img-thumbnail" style="max-width:50px; max-height:50px"></td>
                                <td class="align-middle">{{ $item->product->nombre }}</td>
                                <td class="align-middle">{{ $item->product->precio }}€</td>
                                <td class="align-middle">{{ $item->cantidad }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col text-right">
                        <h2 class="mt-1">Total: {{ $order->importe }}€</h2>
                    </div>
                </div>
                <!-- CANCEL -->
                @if ($order->estado == 'P')
                    <div class="row">
                        <div class="container mt-4 text-center">
                            <a href="{{ route('confirmar', $order->id) }}" class="btn btn-danger">
                                Cancelar pedido
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
