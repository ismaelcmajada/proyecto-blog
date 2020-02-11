<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Author;

class HomeController extends Controller
{
    public function index()
    {
        return view('index', array('arrayPosts'=>Post::all()));
    }

    public function getPost($id) {
        $post = Post::findOrFail($id);
        return view('post', compact('post'));
    }

    public function getAuthor($id) {
        $author = Author::findOrFail($id);
        $arrayPosts = $author->posts()->get();
        return view('author', compact('arrayPosts','author'));
    }
}
