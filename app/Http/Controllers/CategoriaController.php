<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // listar
        $categorias = Categoria::paginate(10);
        return view("admin.categoria.index", compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // mostrar el formulario de creacion
        return "hola";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:categorias|max:30',

        ]);

        if ($validator->fails()) {
            return redirect('/categoria')
                ->withErrors($validator)
                ->withInput();
        }
        // Validacion del lado del servidor
        /*$request->validate([
            "nombre" => "required"
        ]);*/
        // JSON
        // guardar los datos en la base de datos
        $cat = new Categoria;
        $cat->nombre = $request->nombre;
        $cat->detalle = $request->detalle;
        $cat->save();

        return redirect("/categoria")->with("mensaje", "La categoria se ha registrado Correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        // mostrar un recurso
        // Categoria::find($id)
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        // Cargar el formulario de Editar 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Modificar los datos en la base de datos
        // Validacion del lado del servidor
        $request->validate([
            "nombre" => "required"
        ]);
        // JSON
        // guardar los datos en la base de datos
        $categoria = Categoria::find($id);
        $categoria->nombre = $request->nombre;
        $categoria->detalle = $request->detalle;
        $categoria->save();

        return redirect("/categoria")->with("mensaje", "La categoria se ha modificado Correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Eliminar la categoria
        // $categoria->id
        $categoria = Categoria::find($id);
        $categoria->delete();

        return redirect("/categoria")->with("mensaje", "La categoria se ha eliminado Correctamente");
    }

    public function categoria_por_producto($id)
    {
        $categoria = Categoria::find($id);
        return view("admin.categoria.mostrar_prod", compact('categoria'));
    }
}
