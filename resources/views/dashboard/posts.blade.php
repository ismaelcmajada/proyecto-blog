@extends('layouts.app')

@section('content')
<div class="container">
<table class="table table-striped table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Título</th>
      <th scope="col">Autor</th>
      <th scope="col">Fecha</th>
      <th colspan="2"><a class="btn btn-success float-right" href="">Añadir</a></th>
    </tr>
  </thead>
  <tbody>
  @foreach( $arrayPosts as $key => $post )
    <tr>
      <th scope="row">{{ $post->id }}</th>
      <td>{{ $post->title }}</td>
      <td>{{ $post->author->name }}</td>
      <td>{{ $post->created_at }}</td>
      <td><a class="btn btn-primary" href="">Editar</a></td>
      <td>
        <form action="">
            <input type="submit" class="btn btn-danger" value="Eliminar">
        </form>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>

@stop
