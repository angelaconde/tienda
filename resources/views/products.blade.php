<body class="antialiased">
    @extends('layouts.app')

    @section('content')
        <!-- PRODUCTOS -->
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 p-2 card-container">
                        <div class="card text-center product p-4 pt-5 border-0 h-100 rounded-0">
                            <a href="{{ route('product.show', $product) }}">
                                <img class="img-fluid d-block mx-auto" src="{{ asset('img/product/' . $product->imagen) }}"
                                    alt="{{ $product->nombre }}">
                                <div class="card-body p-4 py-0 h-xs-440p">
                                    <h5 class="card-title font-weight-semi-bold mb-3 w-xl-220p mx-auto">
                                        {{ $product->nombre }}
                                    </h5>
                                    <h3>{{ $product->precio }}€</h3>
                                </div>
                            </a>
                            <!-- AÑADIR AL CARRITO -->
                            <div class="h-100">
                            <form action="{{ route('cart.add') }}" method="post" class="h-100">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <div class="row justify-content-center align-items-end h-50">
                                    <div class="col">
                                        <label for="cantidad" class="col-form-label">Cantidad:</label>
                                    </div>
                                    <div class="col">
                                        <input min="1" id="cantidad" name="cantidad" value="1" type="number"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row justify-content-center align-items-end h-50">
                                        <button type="submit" name="btn" class="btn btn-dark btn-md"> <i
                                                class="fas fa-shopping-cart mb-2 pr-2"></i>Añadir al carrito
                                        </button>
                                </div>
                            </form>
                            </div>
                            <!-- FIN DE CARRITO -->
                        </div>
                    </div>
                @endforeach
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
            <!-- PAGINACION -->
            <div class="d-flex">
                <div class="mx-auto">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        <!-- FIN DE PRODUCTOS -->
    @endsection
</body>
