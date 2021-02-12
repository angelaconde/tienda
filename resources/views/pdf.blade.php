<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gracias por su pedido</title>
</head>

<body>
    <div>
        <div>
            <h2>Gracias por su pedido.</h2>
            <!-- ARTICULOS -->
            <div>
                <h3>Ha adquirido los siguientes artículos:</h3>
                <table>
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>PRECIO SIN IVA</th>
                            <th>IVA</th>
                            <th>PRECIO CON IVA</th>
                            <th>CANTIDAD</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::getContent()->sortBy('name') as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->attributes->priceWithoutVAT }}€</td>
                                <td>{{ $item->attributes->vat }}
                                    ({{ $item->attributes->vatPercent }}%)</td>
                                <td>{{ $item->price }}€</td>
                                <td>{{ $item->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- DIRECCION -->
            <div>
                <h3>Su pedido se enviará a la siguiente dirección:</h3>
                <h4>Nombre: {{ session('address.name') }} {{ session('address.surname') }}</h4>
                <h4>Dirección: {{ session('address.direccion') }}</h4>
                <h4>{{ session('address.cp') }} {{ session('address.poblacion') }}
                    ({{ session('address.provincia') }})
                </h4>
            </div>
            <!-- PAGO -->
            <div>
                <h3>
                    Ha pagado la cantidad total de:
                </h3>
                <h2>{{ Cart::getTotal() }}€</h2>
            </div>
        </div>
    </div>
</body>

</html>
