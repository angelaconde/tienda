<?php
use App\Http\Controllers\CategoryController;
$category = CategoryController::index();
?>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link h4" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            @foreach ($category as $category)
                <li class="nav-item">
                    <a class="nav-link h4" href="#">{{ $category->nombre }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
<!-- FIN DE NAVBAR -->
