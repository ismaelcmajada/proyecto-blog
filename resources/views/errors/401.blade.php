@extends('layouts.app')

@section('content')
<div class="container">
    <img src="{{asset('img/401.svg')}}" class="img-fluid" alt="error 401">
    <h3>No tienes permiso para acceder a esta página.</h3>
</div>
@stop