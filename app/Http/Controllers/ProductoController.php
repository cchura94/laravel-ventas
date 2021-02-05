<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'])->except("create");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->buscar) {
            $productos = Producto::where('nombre', 'like', '%' . $request->buscar . '%')
                ->orWhere('cantidad', 'like', '%' . $request->buscar . '%')
                ->paginate(10);
        } else {
            $productos = Producto::paginate(10);
        }
        return view("admin.producto.listar", compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::All();
        return view("admin.producto.crear", compact('categorias'));
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
            return redirect('/producto/create')
                ->withErrors($validator)
                ->withInput();
        }

        /*
        //return back()->with('datos',$request);
        Categoria::findorFail($request->categoria_id);
        //Validar
        $reglas = [
            "nombre" => "required|min:2|max:200|unique:productos",
            
        ];
         $validator = $request->validate($reglas);*/

        //guardar en la base de datos
        $prod = new Producto;
        $prod->nombre = $request->nombre;
        $prod->precio = $request->precio;
        $prod->cantidad = $request->cantidad;
        $prod->descripcion = $request->descripcion;
        $prod->categoria_id = $request->categoria_id;
        $prod->estado = $request->estado;
        $prod->save();

        return redirect("/producto")->with("mensaje", "Producto Registrado");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $producto = Producto::findOrFail($id);

        return view("admin.producto.mostrar", compact("producto"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);

        return view("admin.producto.editar", compact("producto"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
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
            return redirect('/producto/create')
                ->withErrors($validator)
                ->withInput();
        }

        $prod = Producto::find($id);
        $prod->nombre = $request->nombre;
        $prod->precio = $request->precio;
        $prod->cantidad = $request->cantidad;
        $prod->descripcion = $request->descripcion;
        $prod->categoria_id = $request->categoria_id;
        $prod->save();

        return redirect("/producto")->with("mensaje", "Producto Modificado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();
        return redirect("/producto")->with("mensaje", "Producto Eliminado");
    }
}
