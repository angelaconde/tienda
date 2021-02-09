@extends('layouts.app')

@section('content')

    <div class="container col-6 p-2">
        <div class="jumbotron text-center">
            <h2>ADVERTENCIA</h2>
            <h3>Está a punto de eliminar su cuenta.</h3>
            <h3>¡Esta acción no se puede deshacer!</h3>
            <div class="row text-center">
                <div class="col">
                    <a href="{{ route('users.delete', Auth::user()) }}" class="btn btn-primary">Eliminar cuenta</a>
                </div>
            </div>
        </div>
    </div>

@endsection
