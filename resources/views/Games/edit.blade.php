@extends('Games.form')

@section('formName')
    Editar a <b>{{ $game->name }}</b>
@endsection

@section('formAction', route('games.update', $game->id))

@section('method')
    @method('PUT')
@endsection
