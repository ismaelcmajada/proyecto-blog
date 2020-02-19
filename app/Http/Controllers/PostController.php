<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Author;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $author = Auth::user()->author;
        $arrayPosts = Post::where('author_id', $author->id)->orderBy('created_at', 'desc')->get();

        return view('dashboard/posts', compact('arrayPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arrayCategories = Category::all();
        return view('dashboard/postCreate', compact('arrayCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->content = $request->content;
        $post->author_id = Auth::user()->author->id;
        $post->category_id = $request->category;
        $post->save();
        return redirect()->action('PostController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $author = $author = Auth::user()->author;
        if($post->author_id == $author->id) {
            $arrayCategories = Category::all();
            return view('dashboard/postEdit', compact('post', 'arrayCategories'));
        } else {
            return "No tienes permiso para eso.";
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $author = $author = Auth::user()->author;
        if($post->author_id == $author->id) {
            $post->title = $request->title;
            $post->subtitle = $request->subtitle;
            $post->content = $request->content;
            $post->category_id = $request->category;
            $post->save();
            return redirect()->action('PostController@index');
        } else {
            return "No tienes permiso para eso.";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $author = $author = Auth::user()->author;
        if($post->author_id == $author->id) {
            $post->delete();
            return redirect()->action('PostController@index');
        } else {
            return "No tienes permiso para eso.";
        }
    }
}
