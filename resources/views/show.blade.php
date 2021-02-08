<body class="antialiased">

    @extends('layouts.app')

    @section('content')
        <!-- DETALLE DE PRODUCTO -->
        <div class="container p-4">
            <div class="row">
                <div class="col-12 col-md-6">
                    <img src="{{ asset('img/product/' . $product->imagen) }}" alt="{{ $product->nombre }}"
                        class="img-fluid">
                </div>
                <div class="col-12 col-md-6">
                    <h4>{{ $product->nombre }}</h4>
                    <div class="row align-items-center">
                        <div class="col-3">
                            <h1><strong>{{ $product->precio_total }}€</strong></h1>
                        </div>
                        <div class="col">
                            <p>IVA INCLUIDO</p>
                        </div>
                    </div>
                    <h5 class="pt-1">{{ $product->descripcion }}</h5>
                    <hr>
                    <!-- AÑADIR AL CARRITO -->
                    <p class="text-muted">Stock: {{ $product->stock == 0 ? 'AGOTADO' : $product->stock }}</p>
                    <form action="{{ route('cart.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="form-row align-items-center">
                            <div class="col-2">
                                <label for="cantidad" class="col-form-label">Cantidad:</label>
                            </div>
                            <div class="col-2">
                                <input min="1" max="{{ $product->stock }}" id="cantidad" name="cantidad" value="1"
                                    type="number" class="form-control">
                            </div>
                            <div class="col">
                                <button type="submit" name="btn" class="btn btn-dark btn-md"
                                    {{ $product->stock == 0 ? 'disabled' : '' }}> <i
                                        class="fas fa-shopping-cart mb-2 pr-2"></i>Añadir al carrito
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- FIN DE CARRITO -->
                </div>
            </div>
            <!-- ALERTA DE PRODUCTO AÑADIDO -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <!-- FIN DE ALERTA -->
        </div>
        <!-- FIN DE DETALLE DE PRODUCTO -->
    @endsection

</body>
