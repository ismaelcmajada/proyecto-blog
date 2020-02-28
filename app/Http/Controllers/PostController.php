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

        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['author', 'admin']);

        if(Auth::user()->hasRole('admin')) {
            $arrayPosts = Post::orderBy('created_at', 'desc')->paginate(10); //En caso de ser admin, devolvemos todos los posts.
        } else {
            $author = Auth::user()->author;
            $arrayPosts = Post::where('author_id', $author->id)->orderBy('created_at', 'desc')->paginate(10); //En caso contrario devolvemos solos los posts del autor.
        }

        //Devolvemos la vista con los arrays correspondientes.

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

        //Autorizamos a los usuarios con los roles especificados.

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

        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['author', 'admin']);

        //Guardamos el nuevo registro.

        $post = new Post;
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;

        //Guardamos la imagen

        if ($request->hasFile('imagen')) {
            if ($request->file('imagen')->isValid()) {
        
                $path = $request->imagen->store('images', 'public');
                $post->imagen = $path;
                
            }
        }

        $post->content = $request->content;

        //En caso de ser administrador, el autor se manda por el formulario.

        if(Auth::user()->hasRole('admin')) {
            $post->author_id = $request->author;
        } else { //En caso contrario el autor es el propio usuario.
            $post->author_id = Auth::user()->author->id;
        }

        $post->category_id = $request->category;
        $post->save();

        //Devolvemos la vista.

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

        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['author', 'admin']);

        //Verificamos que el usuario es el autor del post.

        $post->verifyAuthor(Auth::user());

        //Devolvemos la vista con los arrays correspondientes.

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
        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['author', 'admin']);

        //Verificamos que el usuario es el autor del post.

        $post->verifyAuthor(Auth::user());

        //Modificamos los campos del registro.

        $post->title = $request->title;
        $post->subtitle = $request->subtitle;

        //Guardamos la nueva imagen.

        if ($request->hasFile('imagen')) {
            if ($request->file('imagen')->isValid()) {

                Storage::disk('public')->delete($post->imagen); //Borramos la anterior imagen que tuviera el post.
        
                $path = $request->imagen->store('images', 'public');
                $post->imagen = $path;
                
            }
        }

        $post->content = $request->content;
        $post->category_id = $request->category;

        //En caso de ser el usuario administrador, el autor se define a través del formulario.

        if(Auth::user()->hasRole('admin')) {
            $post->author_id = $request->author;
        }

        $post->save();

        //Devolvemos la vista

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
        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['author', 'admin']);

        //Verificamos que el usuario es el autor del post.

        $post->verifyAuthor(Auth::user());

        //Eliminamos la imagen del post.

        Storage::disk('public')->delete($post->imagen);

        //Eliminamos el registro.

        $post->delete();

        //Devolvemos la vista.

        return redirect()->action('PostController@index');
    }
}
