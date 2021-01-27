<?php
use App\Models\Category;
$category = Category::all();
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
                    <li class="nav-item active">
                        <a class="nav-link h5" href="#">Destacados <span class="sr-only">(current)</span></a>
                    </li>
                    @foreach ($category as $category)
                        <li class="nav-item">
                            <a class="nav-link h5"
                                href="{{ route('categoria', $category->id) }}">{{ $category->nombre }}</a>
                        </li>
                    @endforeach
                </div>
            </ul>
            <ul class="navbar-nav ml-auto">
                <div class="container">
                    <span class="badge badge-pill badge-light">0</span>
                    <a class="nav-link h3" href="#"><i class="fas fa-shopping-cart"></i></a>
                </div>
            </ul>
        </div>
    </div>
</nav>
<!-- FIN DE NAVBAR -->
