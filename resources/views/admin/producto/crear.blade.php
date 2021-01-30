@extends("layouts.admin")

@section("titulo", "Nuevo producto")

@section("contenedor")
<h1>Crear Nuevo producto</h1>

<div class="card">
    <div class="card-body">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        @endif
        <form action="{{ route('producto.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="">NOMBRE</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control" required>

                </div>
                <div class="col-md-3">
                    <label for="">PRECIO</label>
                    <input type="number" step="0.01" name="precio" value="{{ old('precio') }}" class="form-control">

                </div>
                <div class="col-md-3">
                    <label for="">CANTIDAD</label>
                    <input type="number" name="cantidad" value="{{ old('cantidad') }}" class="form-control">

                </div>
                <div class="col-md-5">
                    <label for="">SELECCIONAR CATEGORIA:</label>
                    <select name="categoria_id" id="" class="form-control">
                        @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-7">
                    <label for="">DESCRIPCION:</label>
                    <textarea name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                </div>
                <div class="col-md-5">
                    <div class="input-group ">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="validatedInputGroupCustomFile" name="imagen">
                            <label class="custom-file-label" for="validatedInputGroupCustomFile">IMAGEN...</label>
                        </div>

                    </div>
                </div>
                <div class="col-md-7">
                    <label for="">ESTADO</label>
                    <label for="e1">ACTIVO</label>
                    <input type="radio" name="estado" value="1" id="e1" checked>
                    <label for="e2">INACTIVO</label>
                    <input type="radio" name="estado" value="0" id="e2">
                </div>

                <input type="submit" class="btn btn-primary">

            </div>




        </form>

    </div>
</div>

@endsection