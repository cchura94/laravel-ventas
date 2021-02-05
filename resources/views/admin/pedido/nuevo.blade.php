@extends('layouts.admin')

@section('titulo', 'Nuevo Pedido')

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endsection


@section('contenedor')

{!! QrCode::size(150)->generate('PEDIDO') !!}
<form action="{{ route('pedido.store') }}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">CLIENTE:</h3>
        </div>
        <div class="card-body">
            <label for="">Ingrese Nombre Cliente</label>
            <input type="text" class="form-control" name="nombre_cliente">

            <label for="">Ingrese CI / NIT</label>
            <input type="text" class="form-control" name="ci_nit">

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista Productos</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>PRECIO</th>
                        <th>CANTIDAD</th>
                        <th>CATEGORIA</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($productos as $prod)
                    <tr>
                        <td>{{ $prod->nombre }}</td>
                        <td>{{ $prod->precio }}</td>
                        <td>{{ $prod->cantidad }}</td>
                        <td>{{ $prod->categoria->nombre }}</td>
                        <td>
                            <input type="checkbox" value="{{ $prod->id }}" name="productos[]" id="">

                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>NOMBRE</th>
                        <th>PRECIO</th>
                        <th>CANTIDAD</th>
                        <th>ACCION</th>
                        <th>ACCIONES</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card">
        <div class="card-body">
            <input type="submit" class="btn btn-primary btn-float-right" value="Realizar pedido">
        </div>
    </div>
</form>

@endsection