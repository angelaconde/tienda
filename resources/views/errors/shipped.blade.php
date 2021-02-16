<body class="antialiased">

    @extends('layouts.app')

    @section('content')
        <div class="container text-center">
            <div class="jumbotron m-2">
                <h1 class="display-5 text-center">No puede cancelar un pedido que ya ha sido enviado.</h1>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="{{ url()->previous() }}" role="button"><i
                            class="fas fa-undo-alt"></i> Volver</a>
                </p>
            </div>
        </div>
    @endsection

</body>
