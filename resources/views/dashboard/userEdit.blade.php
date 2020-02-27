@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Datos de usuario</h2>
    <form action="{{action('UserController@update', $user)}}" class="mb-4" method="post">
        {{ method_field('PUT') }}
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="correo">Email</label>
            <input type="text" name="correo" id="correo" class="form-control" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="verificado">Verificado</label>
            <input type="checkbox" name="verificado" id="verificado" value="verificado"
            @if (!empty($user->email_verified_at))
                checked
            @endif
            >
        </div>
        <input type="submit" class="btn btn-success" value="Editar">
    </form>

    @if ($user->author)
    <h2>Perfil de autor</h2>
    <form action="{{action('AuthorController@update', $user->author)}}" method="post">
        {{ method_field('PUT') }}
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $user->author->name }}">
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" cols="30" rows="10">{{ $user->author->description }}</textarea>
        </div>
        <input type="submit" class="btn btn-success" value="Editar">
    </form>
    <form action="{{action('AuthorController@destroy', $user->author)}}" method="POST">
        {{ method_field('DELETE') }}
        {!! csrf_field() !!}
        <button type="submit" class="btn btn-danger" style="display:inline">
            Borrar
        </button>
    </form>
    @endif
</div>

@stop
