<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Author;
use App\Category;

class HomeController extends Controller
{
    public function index()
    {
        $arrayPosts = Post::orderBy('created_at', 'desc')->get();
        $arrayCategories = Category::all();
        return view('index', compact('arrayPosts', 'arrayCategories'));
    }

    public function indexCategory($name)
    {
        $categoryId = Category::where('name', $name)->firstOrFail()->id;
        $arrayPosts = Post::all()->where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
        $arrayCategories = Category::all();
        return view('index', compact('arrayPosts', 'arrayCategories'));
    }

    public function getPost($id) {
        $post = Post::findOrFail($id);
        return view('post', compact('post'));
    }

    public function getAuthor($id) {
        $author = Author::findOrFail($id);
        $arrayPosts = $author->posts()->orderBy('created_at', 'desc')->get();
        return view('author', compact('arrayPosts','author'));
    }
}
