<?php

namespace App\Exports;

use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrderExport implements FromView
{
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get table with order products
     *  
     * @return View
     */
    public function view(): View
    {
        $items = OrderProduct::where('pedidos_id', $this->id)->get();
        foreach ($items as $item) {
            $product = Product::where('id', $item->articulos_id)->firstOrFail();
            $item->product = $product;
        }
        return view('excelpedido', [
            'items' => $items
        ]);
    }
}
