@extends('layouts.app')

@section('content')

    <div class="container col-6 p-2">
        <div class="jumbotron text-center">
            <h2>ADVERTENCIA</h2>
            <h3>Está a punto de cancelar este pedido.</h3>
            <h3>¡Esta acción no se puede deshacer!</h3>
            <div class="row text-center p-4">
                <div class="col">
                    <a href="{{ route('cancelar', $id) }}" class="btn btn-danger"><i
                            class="fas fa-exclamation-triangle"></i>
                        Confirmar y cancelar pedido
                    </a>
                </div>
                <div class="col">
                    <a class="btn btn-primary" href="{{ url()->previous() }}" role="button"><i
                            class="fas fa-undo-alt"></i> Volver sin cancelar</a>
                </div>
            </div>
        </div>
    </div>

@endsection
