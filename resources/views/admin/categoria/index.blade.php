@extends("layouts.admin")

@section("titulo", "Gestion Categoria")

@section("contenedor")





<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Agregar Nueva Categoria
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categoria.store') }}" method="post">
                <div class="modal-body">
                    @csrf

                    <label for="">NOMBRE:</label>
                    <input type="text" name="nombre" class="form-control">

                    <label for="">DETALLE:</label>
                    <textarea name="detalle" id="" class="form-control"></textarea>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Categoria</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(session('mensaje'))
<div class="alert alert-success">
    <p>{{ session('mensaje') }}</p>
</div>
@endif

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>DETALLE</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categorias as $cat)
        <tr>
            <td>{{ $cat->id }}</td>
            <td>{{ $cat->nombre }}</td>
            <td>{{ $cat->detalle }}</td>
            <td>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editarModal{{ $cat->id }}">
                    editar
                </button>

                <!-- Modal -->
                <div class="modal fade" id="editarModal{{ $cat->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">EDITAR {{ $cat->nombre }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('categoria.update', $cat->id) }}" method="post">
                                <div class="modal-body">
                                    @csrf
                                    @Method('PUT')

                                    <label for="">NOMBRE:</label>
                                    <input type="text" name="nombre" class="form-control" value="{{ $cat->nombre }}">

                                    <label for="">DETALLE:</label>
                                    <textarea name="detalle" id="" class="form-control">{{ $cat->detalle }}</textarea>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">EDITAR Categoria</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#Modal{{ $cat->id }}">
                    Eliminar
                </button>

                <!-- Modal -->
                <div class="modal fade" id="Modal{{ $cat->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ELIMINAR CATEGORIA {{ $cat->nombre }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Esta Seguro de Eliminar la Categoria {{ $cat->nombre }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <form action="{{ route('categoria.destroy', $cat->id) }}" method="post">
                                    @csrf
                                    @Method('DELETE')
                                    <button type="submit" class="btn btn-primary">Elminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $categorias->links() }}
@endsection