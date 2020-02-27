@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{action('AuthorController@store', $user)}}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
        </div>
        
        <input type="submit" class="btn btn-success" value="Crear">
    </form>
</div>

@stop