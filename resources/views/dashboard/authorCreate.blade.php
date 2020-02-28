@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Crear autor</h2>
        </div>
        <div class="col">
            <a href="{{url()->previous()}}" class="btn btn-primary" >< Volver</a>
        </div>
    </div>

    @if ($errors->any())

    <div class="row justify-content-center">
        <div class="col-sm-7">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    @endif

    <form action="{{action('AuthorController@store', $user)}}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
        </div>
        
        <input type="submit" class="btn btn-success" value="Crear">
    </form>
</div>

@stop