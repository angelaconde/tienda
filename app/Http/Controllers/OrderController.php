<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;

class OrderController extends Controller
{
    /**
     * Checks stock.
     * 
     * @return bool
     */
    public function checkStock()
    {
        $validCart = true;
        foreach (Cart::getContent() as $item) {
            // Check is valid number
            if (!$this->checkStockValid($item)) {
                $validCart = false;
            } else {
                // Get corresponding product
                $producto = Product::findOrFail($item->id);
                // Check if 0 stock
                if (!$this->checkStockNotZero($item, $producto)) {
                    $validCart = false;
                } else {
                    // Check if enough stock
                    if (!$this->checkEnoughStock($item, $producto)) {
                        $validCart = false;
                    }
                }
            }
        }
        return $validCart;
    }

    /**
     * Checks if valid quantity number.
     * 
     * @return bool
     */
    public function checkStockValid($item)
    {
        if ($item->quantity <= 0) {
            Cart::remove($item->id);
            return false;
        }
        return true;
    }

    /**
     * Checks if 0 stock.
     * 
     * @return bool
     */
    public function checkStockNotZero($item, $producto)
    {
        if ($producto->stock == 0) {
            Cart::remove($item->id);
            return false;
        }
        return true;
    }

    /**
     * Checks if enough stock.
     * 
     * @return bool
     */
    public function checkEnoughStock($item, $producto)
    {
        if ($item->quantity > $producto->stock) {
            Cart::update($item->id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $producto->stock
                ),
            ));
            return false;
        }
        return true;
    }

    /**
     * Displays the address form.
     *
     * @return \Illuminate\Http\Response
     */
    public function fillAddress()
    {
        if (!$this->checkStock()) {
            return back()->with('stock_alert', "No hay suficiente stock para completar su pedido. Su carrito ha sido actualizado.");
        }
        return view('order');
    }

    /**
     * Displays the payment details.
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

    /**
     * Stores the order.
     * 
     */
    public function store()
    {
        // ORDER
        $order = new Order;
        $order->email = Auth::user()->email;
        $order->telefono = session('address.telefono');
        $order->name = session('address.name');
        $order->surname = session('address.surname');
        $order->direccion = session('address.direccion');
        $order->cp = session('address.cp');
        $order->poblacion = session('address.poblacion');
        $order->provincia = session('address.provincia');
        $order->fecha = NOW();
        $order->estado = 'P';
        $order->users_id = Auth::user()->id;
        $order->save();
        // PRODUCTS
        $cartItems = Cart::getContent();
        foreach ($cartItems as $item) {
            $product = new OrderProduct;
            $product->pedidos_id = $order->id;
            $product->precio = $item->price;
            $product->articulos_id = $item->id;
            $product->cantidad = $item->quantity;
            $product->save();
        }
    }
}
