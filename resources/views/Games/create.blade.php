@extends('Games.form')

@section('formName')
    Crear
@endsection

@section('formAction', route('games.store'))

@section('method')
    @method('POST')
@endsection