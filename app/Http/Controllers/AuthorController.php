<?php

namespace App\Http\Controllers;

use App\Author;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        Auth::user()->authorizeRoles(['admin']);

        return view('dashboard/authorCreate', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        Auth::user()->authorizeRoles(['admin']);

        $author = new Author;
        $author->name = $request->name;
        $author->description = $request->description;
        $author->user_id = $user->id;
        $author->save();
        $user->roles()->attach(2);
        $user->save();

        return redirect()->action('UserController@index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        Auth::user()->authorizeRoles(['admin']);

        $author->name = $request->nombre;
        $author->description = $request->description;
    
        $author->save();

        return redirect()->action('UserController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        Auth::user()->authorizeRoles(['admin']);

        $author->delete();

        return redirect()->action('UserController@index');
    }
}
