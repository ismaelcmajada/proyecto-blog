@extends('layouts.master')

@section('header')

  <!-- Page Header -->
  <header class="masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>{{ $post->title }}</h1>
            <h2 class="subheading">{{ $post->subtitle }}</h2>
            <span class="meta">Publicado por
              <a href="{{ url('/author').'/'.$post->author_id }}">{{ $post->author->name }}</a>
              el {{ date("d-m-Y", strtotime($post->created_at)) }}</span>
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
          <p>{!! $post->content !!}</p>
        </div>
      </div>
    </div>
  </article>

  <hr>

  @stop
