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
                                    <p>{{ $product->precio }}€</p>
                                </div>
                            </a>
                            <p class="btn w-100 px-4 mx-auto mt-auto">
                                <button type="button" class="btn btn-dark btn-md">
                                    <i class="fas fa-shopping-cart mb-2 pr-2"></i>Añadir al carrito
                                </button>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
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