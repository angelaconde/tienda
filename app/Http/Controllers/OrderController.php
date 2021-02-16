<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Mail\OrderReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use PDF;

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
            // ADD TO TABLE articulos_pedido
            $orderProduct = new OrderProduct;
            $orderProduct->pedidos_id = $order->id;
            $orderProduct->precio = $item->price;
            $orderProduct->articulos_id = $item->id;
            $orderProduct->cantidad = $item->quantity;
            $orderProduct->save();
            // UPDATE QUANTITY IN TABLE articulos
            $product = new ProductController;
            $product->update($item->id, $item->quantity);
        }
        // SEND EMAIL
        Mail::to(Auth::user()->email)->send(new OrderReceived());
        // EMPTY CART
        Cart::clear();
    }

    /**
     * Display a listing of the resource by user id.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByUser($user_id)
    {
        // Check if logged user
        if (Auth::user()) {
            // Check if logged user is the owner
            if (Auth::user()->id == $user_id) {
                $orders = Order::where('users_id', $user_id)->get();
                foreach ($orders as $order) {
                    $importe = OrderProduct::where('pedidos_id', $order->id)->sum(DB::raw('precio * cantidad'));
                    $order->importe = $importe;
                }
                return view('orders')->with('orders', $orders);
            } else {
                return view('errors.denegado');
            }
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Check if logged user
        if (Auth::user()) {
            $order = Order::findOrFail($id);
            // Check if currently logged user is the owner
            if (Auth::user()->id == $order->users_id) {
                $importe = OrderProduct::where('pedidos_id', $id)->sum(DB::raw('precio * cantidad'));
                $order->importe = $importe;
                $items = OrderProduct::where('pedidos_id', $id)->get();
                foreach ($items as $item) {
                    $product = Product::where('id', $item->articulos_id)->firstOrFail();
                    $item->product = $product;
                }
                return view('detalle')->with([
                    'order' => $order,
                    'items' => $items,
                ]);
            } else {
                return view('errors.denegado');
            }
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Cancel the order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        // Check if logged user
        if (Auth::user()) {
            $order = Order::findOrFail($id);
            // Check if currently logged user is the owner
            if (Auth::user()->id == $order->users_id) {
                // Check if order has not shipped
                if ($order->estado == 'P') {
                    // Change status to cancelled
                    $order->estado = 'C';
                    $order->save();
                    // Put stock back
                    $items = OrderProduct::where('pedidos_id', $id)->get();
                    foreach ($items as $item) {
                        $product = Product::where('id', $item->articulos_id)->firstOrFail();
                        $product->stock = $product->stock + $item->cantidad;
                        $product->save();
                    }
                    return redirect()->route('pedidos', ['user' => Auth::user()->id]);
                } else {
                    return view('errors.shipped');
                }
            } else {
                return view('errors.denegado');
            }
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Confirmation to cancel the order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelConfirm($id)
    {
        // Check if logged user
        if (Auth::user()) {
            $order = Order::findOrFail($id);
            // Check if currently logged user is the owner
            if (Auth::user()->id == $order->users_id) {
                // Check if order has not shipped
                if ($order->estado == 'P') {
                    return view('cancelconfirm')->with('id', $order->id);
                } else {
                    return view('errors.shipped');
                }
            } else {
                return view('errors.denegado');
            }
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Get PDF invoice
     * 
     */
    public function downloadPDF($id)
    {
        $order = Order::findOrFail($id);
        $importe = OrderProduct::where('pedidos_id', $id)->sum(DB::raw('precio * cantidad'));
        $order->importe = $importe;
        $items = OrderProduct::where('pedidos_id', $id)->get();
        foreach ($items as $item) {
            $product = Product::where('id', $item->articulos_id)->firstOrFail();
            $item->product = $product;
        }
        $pdf = PDF::loadView('factura', ['order' => $order, 'items' => $items]);
        return $pdf->download('factura.pdf');
    }
}
