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
                'price' => $producto->precio_total,
                'quantity' => $request->cantidad,
                'attributes' => array(
                    'image' => $producto->imagen,
                    'vatPercent' => $producto->iva,
                    'vat' => $producto->importe_iva,
                    'priceWithoutVAT' => $producto->precio,
                    'stock' => $producto->stock,
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

    public function updateQuantity(Request $request)
    {
        Cart::update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->cantidad
            ),
        ));
        return back()->with('success', "Se ha modificado la cantidad.");
    }
}
