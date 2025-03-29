@extends('layout')
@section('title')
    Listado
@endsection
@section('body')
    @if ($msj = Session::get('success'))
        <div class="row" id="alerta">
            <div class="col-md-4 offset-md-4">
                <div class="alert alert-success">
                    <p><i class="fas fa-check"></i>{{ $msj }}</p>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Niveles</th>
                            <th scope="col">Lanzamiento</th>
                            <th>Imagen</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($games as $i =>$row)
                            <tr>
                                <th scope="row">{{ ($i)+1 }}</th>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->levels }}</td>
                                <td>{{ $row->release }}</td>
                                <td>
                                    <img class="img-fluid" width="100" src="/storage/{{ $row->image }}" alt="">
                                </td>
                                <td>
                                    <a href="{{ route('games.edit',$row->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form id="frm_{{$row->id}}" action="{{ route('games.destroy', $row->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalConfirmacion" 
                                        onclick="setInfo({{ $row->id }},'{{ $row->name }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Modal Confirmación -->
<div class="modal fade" tabindex="-1" id="modalConfirmacion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Seguro que desea eliminar?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    <i class="fas fa-warning fs-3 text-warning"></i>
                    <label id="lblNombre"></label>
                </p>
            </div>
            <div class="modal-footer">
                <!-- Botón de Confirmación -->
                <button type="button" id="btnEliminar" class="btn btn-success">Continuar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    @vite('resources/js/games/index.js')
@endsection
