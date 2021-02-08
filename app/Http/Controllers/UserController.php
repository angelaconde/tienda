<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Rules\NifNie;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view(User $user){
        $user = Auth::user();
        return view('auth.userprofile', compact('user'));
    }

    public function edit(User $user)
    {   
        $user = Auth::user();
        return view('auth.edituser', compact('user'));
    }

    public function update(User $user)
    { 
        $this->validate(request(), [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'numeric', 'min:9'],
            'nif' => [new NifNie, 'required', 'string', 'max:45'],
            'direccion' => ['required', 'string', 'max:255'],
            'cp' => ['required', 'numeric', 'digits:5'],
            'poblacion' => ['required', 'string', 'max:45'],
            'provincia' => ['required', 'string', 'max:45'],
        ]);

        $user->name = request('name');
        $user->surname = request('surname');
        $user->telefono = request('telefono');
        $user->nif = request('nif');
        $user->direccion = request('direccion');
        $user->cp = request('cp');
        $user->poblacion = request('poblacion');
        $user->provincia = request('provincia');

        $user->save();

        return view('auth.userprofile', compact('user'));
    }
}