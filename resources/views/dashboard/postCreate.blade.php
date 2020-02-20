@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{action('PostController@store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label for="subtitle">Subtítulo</label>
            <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{old('subtitle')}}">
        </div>
        <div class="form-group">
            <label for="category">Categoría</label>
            <select name="category" id="category" class="form-control">
                @foreach( $arrayCategories as $key => $category )
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @if (Auth::user()->hasRole('admin'))
            <label for="author">Autor</label>
            <select name="author" id="author" class="form-control">
                @foreach( $arrayAuthors as $key => $author )
                <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
            @endif
        </div>
        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{old('content')}}</textarea>
        </div>
        <input type="submit" class="btn btn-success" value="Crear">
    </form>
</div>

@stop
