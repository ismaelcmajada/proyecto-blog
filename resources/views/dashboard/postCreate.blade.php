@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{action('PostController@store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="subtitle">Subtítulo</label>
            <input type="text" name="subtitle" id="subtitle" class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="category">Categoría</label>
            <select name="category" id="category" class="form-control">
                @foreach( $arrayCategories as $key => $category )
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
        </div>
        <input type="submit" class="btn btn-success" value="Crear">
    </form>
</div>

@stop
