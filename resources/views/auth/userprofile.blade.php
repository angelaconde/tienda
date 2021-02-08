@extends('layouts.app')

@section('content')

    <div class="container col-6 p-2">
        <div class="jumbotron">
            <div class="row">
                <div class="col-2">
                    <h4 class="font-weight-bold">Nombre:</h4>
                </div>
                <div class="col">
                    <h4>{{ $user->name }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="font-weight-bold">Apellidos:</h4>
                </div>
                <div class="col">
                    <h4>{{ $user->surname }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="font-weight-bold">Email:</h4>
                </div>
                <div class="col">
                    <h4>{{ $user->email }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="font-weight-bold">Teléfono:</h4>
                </div>
                <div class="col">
                    <h4>{{ $user->telefono }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="font-weight-bold">DNI/NIF:</h4>
                </div>
                <div class="col">
                    <h4>{{ $user->nif }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="font-weight-bold">Dirección:</h4>
                </div>
                <div class="col">
                    <h4>{{ $user->direccion }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="font-weight-bold">CP:</h4>
                </div>
                <div class="col">
                    <h4>{{ $user->cp }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="font-weight-bold">Población:</h4>
                </div>
                <div class="col">
                    <h4>{{ $user->poblacion }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <h4 class="font-weight-bold">Provincia:</h4>
                </div>
                <div class="col">
                    <h4>{{ $user->provincia }}</h4>
                </div>
            </div>
            <div class="row text-center">
                <div class="col">
                    <a href="{{ route('users.edit', Auth::user()) }}" class="btn btn-primary">Modificar datos</a>
                </div>
            </div>
        </div>
    </div>

@endsection
