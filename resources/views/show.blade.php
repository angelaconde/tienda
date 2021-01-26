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
                            <h1><strong>{{ $product->precio }}€</strong></h1>
                        </div>
                        <div class="col">
                            <p>IVA INCLUIDO</p>
                        </div>
                    </div>
                    <h5 class="pt-1">{{ $product->descripcion }}</h5>
                    <hr>

                    <form class="form">
                        <div class="form-row align-items-center">
                                <label for="cantidad" class="col-form-label">Cantidad:</label>
                                <div class="col-2">
                                <input min="1" id="cantidad" name="cantidad" value="1" type="number" class="form-control">
                            </div>
                            <div class="col">
                            <button type="button" class="btn btn-dark btn-md">
                                <i class="fas fa-shopping-cart mb-2 pr-2"></i>Añadir al carrito
                            </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <!-- FIN DE DETALLE DE PRODUCTO -->
    @endsection

</body>
