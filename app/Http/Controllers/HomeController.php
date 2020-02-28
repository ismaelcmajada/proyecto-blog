<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Author;
use App\Category;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        //Devolvemos la vista con los arrays correspondientes.
        $arrayPosts = Post::orderBy('created_at', 'desc')->paginate(10);
        $arrayCategories = Category::all();
        return view('index', compact('arrayPosts', 'arrayCategories'));
    }

    public function indexCategory($name)
    {
        //Devolvemos la vista buscando los posts por categoría.
        $categoryId = Category::where('name', $name)->firstOrFail()->id;
        $arrayPosts = Post::where('category_id', $categoryId)->orderBy('created_at', 'desc')->paginate(10);
        $arrayCategories = Category::all();
        return view('index', compact('arrayPosts', 'arrayCategories'));
    }

    public function getPost($id) {
        //Devolvemos la vista de un post en específico por id.
        $post = Post::findOrFail($id);
        return view('post', compact('post'));
    }

    public function getAuthor($id) {
        //Devolvemos la vista de un autor en específico por id.
        $author = Author::findOrFail($id);
        $arrayPosts = $author->posts()->orderBy('created_at', 'desc')->paginate(10);
        return view('author', compact('arrayPosts','author'));
    }
}
