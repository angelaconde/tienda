<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class CartController extends Controller
{
    public function add(Request $request)
    {

        $producto = Product::find($request->id);

        Cart::add(
            array(
                'id' => $producto->id,
                'name' => $producto->nombre,
                'price' => $producto->precio,
                'quantity' => $request->cantidad,
                'attributes' => array(
                    'image' => $producto->imagen
                )
            )
        );
        return back()->with('success', "$producto->nombre se ha agregado con éxito al carrito.");
    }

    public function cart()
    {
        return view('checkout');
    }

    public function removeitem(Request $request)
    {
        Cart::remove([
            'id' => $request->id,
        ]);
        return back()->with('success', "Producto eliminado con éxito de su carrito.");
    }

    public function clear()
    {
        Cart::clear();
        return back()->with('success', "Se ha vaciado el carrito.");
    }
}
