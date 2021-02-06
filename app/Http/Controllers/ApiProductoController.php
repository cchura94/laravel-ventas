<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;

class ApiProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::paginate(10);
        return response()->json($productos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|unique:productos|max:200',
            'cantidad' => 'required',
            'estado' => 'required'
        ];
        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            return response()->json(["mensaje" => "Ocurrió un error al registrar el producto", "errores" => $validator]);
        }


        //guardar en la base de datos
        $prod = new Producto;
        $prod->nombre = $request->nombre;
        $prod->precio = $request->precio;
        $prod->cantidad = $request->cantidad;
        $prod->descripcion = $request->descripcion;
        $prod->categoria_id = $request->categoria_id;
        $prod->estado = $request->estado;
        $prod->save();

        return response()->json(["mensaje" => "Producto Registrado"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        return response()->json($producto);
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
        $reglas = [
            'nombre' => 'required|unique:productos|max:200',
            'cantidad' => 'required',
        ];
        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            return response()->json(["error" => "Error al modificar"]);
        }

        $prod = Producto::find($id);
        $prod->nombre = $request->nombre;
        $prod->precio = $request->precio;
        $prod->cantidad = $request->cantidad;
        $prod->descripcion = $request->descripcion;
        $prod->categoria_id = $request->categoria_id;
        $prod->save();

        return response()->json(["mensaje" => "Producto modificado"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return response()->json(["mensaje" => "Producto Eliminado"]);
    }
}
