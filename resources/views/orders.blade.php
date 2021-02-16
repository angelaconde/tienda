@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 bg-light">
                @if ($orders)
                    <table class="table table-striped">
                        <thead class="text-center">
                            <th>IDENTIFICADOR</th>
                            <th>FECHA</th>
                            <th>IMPORTE</th>
                            <th>ESTADO</th>
                            <th>VER DATOS</th>
                            <th>DESCARGAR FACTURA</th>
                        </thead>
                        <tbody class="text-center align-items-middle">
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="align-middle">{{ $order->id }}</td>
                                    <td class="align-middle">{{ date('d/m/Y G:i:s', strtotime($order->fecha)) }}</td>
                                    <td class="align-middle">{{ $order->importe }}€</td>
                                    <td class="align-middle">
                                        @switch($order->estado)
                                            @case('P')
                                            <h5><span class="badge badge-secondary">Pendiente</span></h5>
                                            @break
                                            @case('E')
                                            <h5><span class="badge badge-primary">Enviado</span></h5>
                                            @break
                                            @case('R')
                                            <h5><span class="badge badge-success">Recibido</span></h5>
                                            @break
                                            @case('C')
                                            <h5><span class="badge badge-danger">Cancelado</span></h5>
                                            @break
                                        @endswitch
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('pedido', $order->id) }}"><i class="fas fa-search"></i></a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('factura', $order->id) }}"><i class="fas fa-download"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="container text-center">
                        <div class="jumbotron m-2">
                            <h1 class="display-5 text-center">Aún no has realizado ningún pedido.</h1>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
