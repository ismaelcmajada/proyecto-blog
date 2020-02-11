@extends('layouts.master')

@section('header')

<header class="masthead" style="background-image: url('{{asset('img/home-bg.jpg')}}')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Blog Ismael</h1>
            <span class="subheading">Un blog general para buscar información.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

@stop

@section('content')

<div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        @foreach( $arrayPosts as $key => $post )
        <div class="post-preview">
          <a href="{{ url('/post').'/'.$post->id }}">
            <h2 class="post-title">
              {{ $post->title }}
            </h2>
            <h3 class="post-subtitle">
            {{ $post->subtitle }}
            </h3>
          </a>
          <p class="post-meta">Posted by
            <a href="{{ url('/author').'/'.$post->author_id }}">{{ $post->author->name }}</a>
            on {{ $post->created_at }}</p>
        </div>
        <hr>
        @endforeach
    
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
      </div>
    </div>
  </div>

  <hr>

@stop
