<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Http\Controllers\OrderController;
use Cart;

class PayPalPaymentController extends Controller
{
    public function handlePayment()
    {
        $product = [];
        $product['items'] = [
            [
                'name' => 'Pedido',
                'price' => Cart::getTotal(),
                'desc'  => 'Compra en Supermercado La Marisma',
                'qty' => 1
            ]
        ];
  
        $product['invoice_id'] = 1;
        $product['invoice_description'] = "Compra en Supermercado La Marisma";
        $product['return_url'] = route('success.payment');
        $product['cancel_url'] = route('cancel.payment');
        $product['total'] = Cart::getTotal();

        $paypalModule = new ExpressCheckout;

        $res = $paypalModule->setExpressCheckout($product);
        $res = $paypalModule->setExpressCheckout($product, true);

        return redirect($res['paypal_link']);
    }

    public function paymentCancel()
    {
        return view('pagoerror');
    }

    public function paymentSuccess(Request $request)
    {
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $order = new OrderController;
            $order->store();
            return view('pagocorrecto');
        }

        return view('pagoerror');
    }
}
