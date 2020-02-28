<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostFormRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->authorizeRoles(['author', 'admin']);

        if(Auth::user()->hasRole('admin')) {
            $arrayPosts = Post::orderBy('created_at', 'desc')->paginate(10);
        } else {
            $author = Auth::user()->author;
            $arrayPosts = Post::where('author_id', $author->id)->orderBy('created_at', 'desc')->paginate(10);
        }

        $arrayCategories = Category::all();

        return view('dashboard/post', compact('arrayPosts', 'arrayCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->authorizeRoles(['author', 'admin']);

        $arrayCategories = Category::all();
        $arrayAuthors = Author::all();
        return view('dashboard/postCreate', compact('arrayCategories', 'arrayAuthors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
        Auth::user()->authorizeRoles(['author', 'admin']);

        $post = new Post;
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;

        if ($request->hasFile('imagen')) {
            if ($request->file('imagen')->isValid()) {
        
                $path = $request->imagen->store('images', 'public');
                $post->imagen = $path;
                
            }
        }

        $post->content = $request->content;

        if(Auth::user()->hasRole('admin')) {
            $post->author_id = $request->author;
        } else {
            $post->author_id = Auth::user()->author->id;
        }

        $post->category_id = $request->category;
        $post->save();

        return redirect()->action('PostController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Auth::user()->authorizeRoles(['author', 'admin']);
        $post->verifyAuthor(Auth::user());

        $arrayCategories = Category::all();
        $arrayAuthors = Author::all();
        return view('dashboard/postEdit', compact('post', 'arrayCategories', 'arrayAuthors'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, Post $post)
    {
        Auth::user()->authorizeRoles(['author', 'admin']);
        $post->verifyAuthor(Auth::user());

        $post->title = $request->title;
        $post->subtitle = $request->subtitle;

        if ($request->hasFile('imagen')) {
            if ($request->file('imagen')->isValid()) {

                Storage::disk('public')->delete($post->imagen);
        
                $path = $request->imagen->store('images', 'public');
                $post->imagen = $path;
                
            }
        }

        $post->content = $request->content;
        $post->category_id = $request->category;
        if(Auth::user()->hasRole('admin')) {
            $post->author_id = $request->author;
        }

        $post->save();

        return redirect()->action('PostController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Auth::user()->authorizeRoles(['author', 'admin']);
        $post->verifyAuthor(Auth::user());

        Storage::disk('public')->delete($post->imagen);

        $post->delete();
        return redirect()->action('PostController@index');
    }
}
