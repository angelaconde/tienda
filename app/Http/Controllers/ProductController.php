<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExport;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = env('PAGINATION_PRODUCTS', 8);
        $products = Product::where('oculto', 0)->paginate($pagination);
        return view('products')
            ->with('products', $products)
            ->with('categoria', 'todo');
    }

    /**
     * Display a listing of the resource if it's featured.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByFeatured()
    {
        $pagination = env('PAGINATION_PRODUCTS', 8);
        $products = Product::where('destacado', 1)->where('oculto', 0)->paginate($pagination);
        abort_if($products->isEmpty(), 404);
        return view('products')
            ->with('products', $products)
            ->with('categoria', 'destacado');
    }

    /**
     * Display a listing of the resource by category id.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByCategory($categoria_id)
    {
        $pagination = env('PAGINATION_PRODUCTS', 8);
        $products = Product::where('categorias_id', $categoria_id)->where('oculto', 0)->paginate($pagination);
        abort_if($products->isEmpty(), 404);
        return view('products')
            ->with('products', $products)
            ->with('categoria', $categoria_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('oculto', 0)->findOrFail($id);
        return view('show', [
            'product' => $product,
            'categoria' => $product->categorias_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, $quantity)
    {
        $product = Product::find($id);
        $product->stock = $product->stock - $quantity;
        $product->save();
    }

    /**
     * Get Excel of products
     * 
     * @return \Illuminate\Support\Collection
     */
    public function fileExport()
    {
        return Excel::download(new ProductExport, 'productos.xlsx');
    }
}
