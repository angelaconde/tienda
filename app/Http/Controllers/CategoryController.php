<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoryExport;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories)->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->validate(request(), [
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['string', 'max:255'],
            'anuncio' => ['string', 'max:255'],
            'codigo' => ['required', 'string', 'max:45'],
            'oculto' => ['required', 'numeric', 'max:4'],
        ]);
        $category = new Category;
        $category->nombre = $request->input('nombre');
        $category->descripcion = $request->input('descripcion');
        $category->anuncio = $request->input('anuncio');
        $category->codigo = $request->input('codigo');
        $category->oculto = $request->input('oculto');
        $category->save();
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category = new CategoryResource($category);
            return $category->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
        return "Esa categoría no existe.";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->nombre = $request->input('nombre');
        $category->descripcion = $request->input('descripcion');
        $category->anuncio = $request->input('anuncio');
        $category->codigo = $request->input('codigo');
        $category->oculto = $request->input('oculto');
        $category->save();
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        if ($category->delete()) {
            return  new CategoryResource($category);
        }
        return "No se ha podido eliminar.";
    }

    /**
     * Get Excel of categories
     * 
     * @return \Illuminate\Support\Collection
     */
    public function fileExport()
    {
        return Excel::download(new CategoryExport, 'categorias.xlsx');
    }
}
