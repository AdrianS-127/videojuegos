@extends('layout')

@section('title')
    - @yield('formName')
@endsection

@section('body')
    @if ($errors->any())
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger">
                    <p><b><i class="fas fa-times"></i> Errores</b></p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">@yield('formName')</h4>
                </div>
                <div class="card-body">
                    <form action="@yield('formAction')" method="POST" enctype="multipart/form-data">
                        @csrf  <!-- ✅ Necesario para que POST funcione en Laravel -->
                        @yield('method')

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-gamepad"></i>
                            </span>
                            <input type="text" name="name" class="form-control" placeholder="Nombre del juego" 
                            @isset($game)
                                value="{{ $game->name }}"
                            @endisset required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-trophy"></i>
                            </span>
                            <input type="number" name="levels" class="form-control" placeholder="Niveles del juego" 
                            @isset($game)
                                value="{{ $game->levels }}"
                            @endisset required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-calendar"></i>
                            </span>
                            <input type="date" name="release" class="form-control" placeholder="Fecha de lanzamiento"
                            @isset($game) 
                                value="{{ $game->release }}" 
                            @endisset
                            required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="fas fa-gamepad"></i>
                            </span>
                            <input type="file" name="image" class="form-control" accept="image/*" 
                            @if (!isset($game))
                                required
                            @endif>
                        </div>

                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
