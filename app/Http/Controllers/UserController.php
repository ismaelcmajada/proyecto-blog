<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserFormRequest;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['admin']);

        //Devolvemos la vista con los arrays correspondientes.

        $arrayUsers = User::orderBy('created_at', 'desc')->paginate(10);
        $arrayRoles = Role::all();
        return view('dashboard/user', compact('arrayUsers', 'arrayRoles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['admin']);

        //Devolvemos la vista con los arrays correspondientes.

        $arrayRoles = Role::all();
        return view('dashboard/userEdit', compact('user', 'arrayRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, User $user)
    {
        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['admin']);

        //Modificamos los campos del registro.

        $arrayRoles = Role::all();

        $user->name = $request->nombre;
        $user->email = $request->correo;

        if ($request->verificado=="verificado") {
            $user->email_verified_at = now();
        } else {
            $user->email_verified_at = null;
        }
    
        $user->save();

        //Devolvemos la vista.

        return redirect()->action('UserController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['admin']);

        //Eliminamos el registro

        $user->delete();

        //Devolvemos la vista.

        return redirect()->action('UserController@index');
    }

    //Con este método añadimos roles a un usuario.
    public function addRole(User $user, Role $role)
    {
        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['admin']);

        //Si el usuario no tenía el rol previamente se le añade.

        if (!$user->hasRole($role->name)) {
            
            if($role->name == "author" && !$user->author) { //En caso de añadir el rol de autor, nos reenviará al controlador de los autores para crear un perfil de autor.
                return redirect()->action('AuthorController@create', $user);
            }

            //Añadimos el rol al usuario y lo guardamos.
            $user->roles()->attach($role);
            $user->save();
        }

        //Devolvemos la vista

        return redirect()->action('UserController@index');
    }

    //Con este método quitamos roles a un usuario.
    public function removeRole(User $user, Role $role)
    {
        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['admin']);

        //Si el usuario tiene el rol, se le quita.

        if ($user->hasRole($role->name)) {
            $user->roles()->detach($role);

            $user->save();
        }

        //Devolvemos la vista.
        return redirect()->action('UserController@index');
    }
}
