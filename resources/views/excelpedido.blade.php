<table>
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