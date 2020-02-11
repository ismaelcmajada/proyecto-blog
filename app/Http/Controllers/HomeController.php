<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Auhtor;

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
        return view('author', compact('author'));
    }
}
