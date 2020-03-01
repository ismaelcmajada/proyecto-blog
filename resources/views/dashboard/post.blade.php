@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Publicaciones</h2>
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

    @if (Auth::user()->hasRole('admin'))
    <!-- Modal -->
    <div class="modal fade" id="categorias" tabindex="-1" role="dialog" aria-labelledby="as" aria-hidden="true">
        <div class="modal-dialog" category="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Categorías</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach( $arrayCategories as $key => $category )
                    <div class="row">
                        <div class="col-8">
                            <form action="{{action('CategoryController@update', $category)}}" method="post"
                                class="mb-2">
                                {{ method_field('PUT') }}
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-8">
                                        <input type="text" class="form-control" name="nombre"
                                            value="{{ $category->name }}">
                                    </div>
                                    <div class="col">
                                        <input type="submit" class="btn btn-primary" value="Editar">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col">
                            <form action="{{action('CategoryController@destroy', $category)}}" method="POST">
                                {{ method_field('DELETE') }}
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-danger" style="display:inline">
                                    Borrar
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    <hr>
                    <form action="{{action('CategoryController@store')}}" method="post" class="mb-2">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="nombre" id="nombre"
                                    value="{{ old('nombre') }}">
                            </div>
                            <div class="col">
                                <input type="submit" class="btn btn-success" value="Crear">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Categoría</th>
                @if (Auth::user()->hasRole('admin'))
                <th scope="col">Autor</th>
                @endif
                <th scope="col">Fecha</th>
                
                <th scope="col">
                @if (Auth::user()->hasRole('admin'))
                <button class="btn btn-primary" data-toggle="modal" data-target="#categorias">Categorías</button>
                @endif
                </th>
                
                <th scope="col"><a href="{{action('PostController@create')}}" class="btn btn-success float-right"
                        href="">Añadir</a></th>
            </tr>
        </thead>
        <tbody>
            @foreach( $arrayPosts as $key => $post )
            <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name }}</td>
                @if (Auth::user()->hasRole('admin'))
                <td>{{ $post->author->name }}</td>
                @endif
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
    {{ $arrayPosts->links() }}
</div>

@stop
