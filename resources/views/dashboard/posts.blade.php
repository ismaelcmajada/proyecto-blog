@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Categoría</th>
                <th scope="col">Fecha</th>
                <th colspan="2"><a href="{{action('PostController@create')}}" class="btn btn-success float-right" href="">Añadir</a></th>
            </tr>
        </thead>
        <tbody>
            @foreach( $arrayPosts as $key => $post )
            <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name }}</td>
                <td>{{ $post->created_at }}</td>
                <td><a class="btn btn-primary" href="{{action('PostController@edit', $post)}}">Editar</a></td>
                <td>
                    <form action="{{action('PostController@destroy', $post)}}" method="POST">
                        {{ method_field('DELETE') }}
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-danger" style="display:inline">
                            Borrar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop
