<body class="antialiased">

    @extends('layouts.app')

    @section('content')
        <!-- TOAST DE PRODUCTO AÑADIDO -->
        @if (session('success'))
            <div class="position-absolute w-100 p-4 d-flex flex-column align-items-end" style="z-index: 1">
                <div class="w-25">
                    <div class="toast ml-auto" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                        <div class="toast-header">
                            <strong class="mr-auto">Producto añadido al carrito</strong>
                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">$('.toast').toast('show');</script>
        @endif
        <!-- FIN DE TOAST -->
        <!-- DETALLE DE PRODUCTO -->
        <div class="container p-4">
            <div class="row">
                <div class="col-12 col-md-6">
                    @if ($product->stock <= 0)
                        <figure class="figure tag tag-out">
                        @elseif ($product->descuento > 0)
                            <figure class="figure tag tag-sale">
                            @else
                                <figure class="figure">
                    @endif
                    <img src="{{ asset('img/product/' . $product->imagen) }}" alt="{{ $product->nombre }}"
                        class="img-fluid">
                    </figure>
                </div>
                <div class="col-12 col-md-6">
                    <h4>{{ $product->nombre }}</h4>
                    <div class="row align-items-center">
                        <div class="col-3">
                            @if ($product->descuento > 0)
                                <h4><s>{{ $product->precio_sin_descuento }}€</s></h4>
                            @endif
                            <h1><strong>{{ $product->precio_total }}€</strong></h1>
                        </div>
                        <div class="col">
                            <p>IVA INCLUIDO</p>
                        </div>
                    </div>
                    <h5 class="pt-1">{{ $product->descripcion }}</h5>
                    <hr>
                    <!-- AÑADIR AL CARRITO -->
                    <p class="text-muted">Stock: {{ $product->stock <= 0 ? 'AGOTADO' : $product->stock }}</p>
                    <form action="{{ route('cart.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="form-row align-items-center">
                            <div class="col-2">
                                <label for="cantidad" class="col-form-label">Cantidad:</label>
                            </div>
                            <div class="col-2">
                                <input min="1"
                                    max="{{ Cart::has($product->id) ? $product->stock - Cart::getContent()->pull($product->id)->quantity : $product->stock }}"
                                    id="cantidad" name="cantidad" value="1" type="number" class="form-control">
                            </div>
                            <div class="col">
                                <button type="submit" name="btn" class="btn btn-dark btn-md"
                                    {{ $product->stock <= 0 ? 'disabled' : '' }}> <i
                                        class="fas fa-shopping-cart mb-2 pr-2"></i>Añadir al carrito
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- FIN DE CARRITO -->
                </div>
            </div>
        </div>
        <!-- FIN DE DETALLE DE PRODUCTO -->
    @endsection

</body>
