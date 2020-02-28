@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Usuarios</h2>
        </div>
        <div class="col">
            <a href="{{url()->previous()}}" class="btn btn-primary" >< Volver</a>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Roles</th>
                <th scope="col">Fecha de registro</th>
                <th colspan="3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach( $arrayUsers as $key => $user )
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach( $user->roles as $key => $role )
                    {{ $role->description }}
                    @endforeach
                </td>
                <td>{{ $user->created_at }}</td>
                <td>

                    <button class="btn btn-primary" data-toggle="modal"
                        data-target="#user{{ $user->id }}">Roles</button>

                    <!-- Modal -->
                    <div class="modal fade" id="user{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="as"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ $user->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @foreach( $arrayRoles as $key => $role )
                                    <div class="row">
                                        <div class="col">
                                            <p>{{ $role->description }}</p>
                                        </div>
                                        <div class="col">
                                            @if($user->hasRole($role->name))
                                            <a class="btn btn-danger"
                                                href="{{action('UserController@removeRole', ['user' => $user, 'role' => $role])}}">Quitar</a>
                                            @else
                                            <a class="btn btn-success"
                                                href="{{action('UserController@addRole', ['user' => $user, 'role' => $role])}}">Añadir</a>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </td>
                <td><a class="btn btn-primary" href="{{action('UserController@edit', $user)}}">Editar</a></td>
                <td>
                    <form action="{{action('UserController@destroy', $user)}}" method="POST">
                        {{ method_field('DELETE') }}
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-danger" style="display:inline">
                            Borrar
                        </button>
                    </form>
                </td>
            </tr>
        </div>
@endforeach
    </tbody>
</table>
{{ $arrayUsers->links() }}



@stop
