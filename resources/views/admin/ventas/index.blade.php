@extends('adminlte::page')

@section('title', 'Gastos')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administracion de ventas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">ventas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'ventas.store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" aria-describedby="helpId"
                                required>
                            {{-- <small id="helpId" class="text-muted">Campo opcional</small> --}}
                        </div>
                        <div class="form-group">
                            <label for="precio">precio</label>
                            <input type="number" name="precio" id="precio" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" value="1" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </div>
        
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-9 pl-4">
                <table id="example" class="table table-bordered table-striped dataTable dtr-inline" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Fecha venta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($ventas as $venta)
                            <tr>
                                <td>{{ $venta->id }}</td>
                                <td>{{ $venta->descripcion }}</td>
                                <td>{{ number_format($venta->precio) }}</td>
                                <td>{{ $venta->cantidad }}</td>
                                <td>{{ number_format($venta->total) }}</td>
                                <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('d M y h:i a') }}</td>
                                <td>
                                    {!! Form::open(['route' => ['ventas.destroy', $venta], 'method' => 'DELETE']) !!}
                                    <button class="btn  btn-danger btn-sm" id="eliminar" type="submit" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Fecha venta</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h2>Ventas Totales: $ {{ number_format($ventasTotales) }}</h2>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="../js/dataTables.js"></script>
    <script src="../js/sweetAlert.js"></script>
    
@stop
