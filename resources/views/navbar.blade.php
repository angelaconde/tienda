<?php
use App\Models\Category;
$category = Category::where('oculto', 0)->get();
?>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <div class="container">
                    <li class="nav-item {{ isset($categoria) && $categoria == 'destacado' ? 'active' : '' }}">
                        <a class="nav-link h5" href="{{ url('/') }}">Destacados
                        </a>
                    </li>
                    @foreach ($category as $category)
                        <li class="nav-item {{ isset($categoria) && $categoria == $category->id ? 'active' : '' }}">
                            <a class="nav-link h5"
                                href="{{ route('categoria', $category->id) }}">{{ $category->nombre }}</a>
                        </li>
                    @endforeach
                    <li class="nav-item {{ isset($categoria) && $categoria == 'todo' ? 'active' : '' }}">
                        <a class="nav-link h5" href="{{ route('todo') }}">Todo
                        </a>
                    </li>
                </div>
            </ul>
            <ul class="navbar-nav ml-auto">
                <div class="container">
                    <span class="badge badge-pill badge-light">{{ Cart::getTotalQuantity() }}</span>
                    <a class="nav-link h3" href="{{ route('cart.checkout') }}"><i class="fas fa-shopping-cart"></i></a>
                </div>
            </ul>
        </div>
    </div>
</nav>
<!-- FIN DE NAVBAR -->
