<?php

namespace App\Http\Controllers;

use App\Author;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthorFormRequest;

class AuthorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['admin']);

        //Devolvemos la vista.

        return view('dashboard/authorCreate', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorFormRequest $request, User $user)
    {

        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['admin']);

        //Guardamos el nuevo registro.

        $author = new Author;
        $author->name = $request->nombre;
        $author->description = $request->description;
        $author->user_id = $user->id;
        $author->save();

        //Una vez creado el autor, le asociamos el rol de autor al usuario y lo guardamos.

        $user->roles()->attach(2);
        $user->save();

        //Devolvemos la vista

        return redirect()->action('UserController@index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorFormRequest $request, Author $author)
    {

        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['admin']);

        //Modificamos los campos del registro.

        $author->name = $request->nombre;
        $author->description = $request->description;
    
        $author->save();

        //Devolvemos la vista.

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

        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['admin']);

        //Eliminamos el registro.

        $author->delete();

        //Devolvemos la vista.

        return redirect()->action('UserController@index');
    }
}
