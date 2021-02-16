<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
    <style>
        table,
        th,
        td {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

    </style>

</head>

<body>

    <div>
        <div>
            <h5>Número de pedido: {{ $order->id }}</h5>
            <h5>Fecha: {{ date('d/m/Y G:i:s', strtotime($order->fecha)) }}</h5>
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
        <div>
            <h4>Nombre: {{ $order->name }} {{ $order->surname }}</h4>
            <h4>Dirección: {{ $order->direccion }}</h4>
            <h4>{{ $order->cp }} {{ $order->poblacion }} ({{ $order->provincia }})</h4>
        </div>
        <div>
            <table>
                <caption>Productos</caption>
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>PRECIO</th>
                        <th>CANTIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->product->nombre }}</td>
                            <td>{{ $item->product->precio }}€</td>
                            <td>{{ $item->cantidad }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <h2>Total: {{ $order->importe }}€</h2>
            </div>
        </div>
    </div>

</body>

</html>
