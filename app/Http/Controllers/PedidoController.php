<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\User;


use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:cajero']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::All();
        return view('admin.pedido.nuevo', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente;
        $cliente->nombres = $request->nombre_cliente;
        $cliente->apellidos = "-";
        $cliente->ci_nit = $request->ci_nit;
        $cliente->save();

        $fecha_actual = now();

        $pedido = new Pedido;
        $pedido->fecha_pedido = $fecha_actual;
        $pedido->estado = 2;
        $pedido->monto_total = 0;
        $pedido->cliente_id = $cliente->id;
        $pedido->save();

        $pedido->productos()->attach($request->productos);

        return redirect("/pedido");

        //return $fecha_actual;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
