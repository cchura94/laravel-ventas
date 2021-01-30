@extends("layouts.admin")

@section("titulo", "Lista Productos")

@section("contenedor")
<h1>Lista de producto</h1>

<div class="card">
    <div class="card-body">

        <a href="{{ route('producto.create') }}" class="btn btn-primary">Nueva Producto</a>
        <form action="{{ route('producto.index') }}" method="get">
            <input type="text" class="form-control" name="buscar">
            <input type="submit" class="btn btn-outline-success" value="Buscar...">
        </form>
        <table class="table table-hover table-striped">
            <tr>
                <td>NOMBRE</td>
                <td>PRECIO</td>
                <td>CANTIDAD</td>
                <td>SUB-TOTAL</td>
                <td>IMAGEN</td>
                <td>CATEGORIA</td>
                <td>ACCIONES</td>
            </tr>
            @foreach($productos as $prod)
            <tr class="@if($prod->cantidad <= 5)table-danger @endif">
                <td>{{ $prod->nombre }}</td>
                <td>{{ $prod->precio }}</td>
                <td>{{ $prod->cantidad }}</td>
                <td>{{ $prod->precio * $prod->cantidad }}</td>
                <td>IMAGEN</td>
                <td>{{ $prod->categoria->nombre }}</td>
                <td>
                    <a href="{{ route('producto.show', $prod->id) }}" class="btn btn-success btn-xs">mostrar</a>

                    <a href="{{ route('producto.edit', $prod->id) }}" class="btn btn-warning btn-xs">editar</a>
                </td>
            </tr>
            @endforeach

        </table>
    </div>

</div>


@endsection