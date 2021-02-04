<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display the address form.
     *
     * @return \Illuminate\Http\Response
     */
    public function fillAddress()
    {
        return view('order');
    }

    /**
     * Display the payment details.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
        return view('payment');
    }

    /**
     * Validates the address.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validateAddress(Request $request)
    {
        $request->session()->put('address', $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'numeric', 'min:9'],
            'direccion' => ['required', 'string', 'max:255'],
            'cp' => ['required', 'numeric', 'digits:5'],
            'poblacion' => ['required', 'string', 'max:45'],
            'provincia' => ['required', 'string', 'max:45']
        ]));
        return redirect()->to('payment');
    }
}
