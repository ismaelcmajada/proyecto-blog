@extends('layouts.master')

@section('header')

  <!-- Page Header -->
  <header class="masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>{{ $author->name }}</h1>
          </div>
        </div>
      </div>
    </div>
  </header>

  @stop

  @section('content')

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <p>{{ $author->description }}</p>
          <h2>Publicaciones de este autor:</h2>
          <hr>
          @foreach( $arrayPosts as $key => $post )
          <div class="post-preview">
            <a href="{{ url('/post').'/'.$post->id }}">
              <h3 class="post-subtitle">
                {{ $post->title }}
              </h2>
            </a>
          </div>
          <hr>
          @endforeach
        </div>
      </div>
    </div>
  </article>

  <hr>

  @stop
