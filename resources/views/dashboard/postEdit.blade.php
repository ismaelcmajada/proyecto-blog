@extends('layouts.app')

@section('content')
<div class="container">

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

    <form action="{{action('PostController@update', $post)}}" method="post" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}">
        </div>
        <div class="form-group">
            <label for="subtitle">Subtítulo</label>
            <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ $post->subtitle }}">
        </div>
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" id="imagen">
        </div>
        <div class="form-group">
            <label for="category">Categoría</label>
            <select name="category" id="category" class="form-control">
                @foreach( $arrayCategories as $key => $category )
                <option value="{{ $category->id }}" @if ($post->category->id == $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
            @if (Auth::user()->hasRole('admin'))
            <label for="author">Autor</label>
            <select name="author" id="author" class="form-control">
                @foreach( $arrayAuthors as $key => $author )
                <option value="{{ $author->id }}" @if ($post->author->id == $author->id) selected @endif>{{ $author->name }}</option>
                @endforeach
            </select>
            @endif
        </div>
        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea class="form-control" name="content" id="content" cols="30"
                rows="10">{{ $post->content }}</textarea>
        </div>
        <input type="submit" class="btn btn-success" value="Editar">
    </form>
</div>

@stop
