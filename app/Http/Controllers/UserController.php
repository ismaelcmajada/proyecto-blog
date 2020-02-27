<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->authorizeRoles(['admin']);

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
        Auth::user()->authorizeRoles(['admin']);

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
    public function update(Request $request, User $user)
    {
        Auth::user()->authorizeRoles(['admin']);

        $arrayRoles = Role::all();

        $user->name = $request->nombre;
        $user->email = $request->correo;

        if ($request->verificado=="verificado") {
            $user->email_verified_at = now();
        } else {
            $user->email_verified_at = null;
        }
    
        $user->save();

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
        Auth::user()->authorizeRoles(['admin']);

        $user->delete();

        return redirect()->action('UserController@index');
    }

    public function addRole(User $user, Role $role)
    {
        Auth::user()->authorizeRoles(['admin']);

        if (!$user->hasRole($role->name)) {
            
            if($role->name == "author") {
                return redirect()->action('AuthorController@create', $user);
            }

            $user->roles()->attach($role);
            $user->save();
        }

        return redirect()->action('UserController@index');
    }

    public function removeRole(User $user, Role $role)
    {
        Auth::user()->authorizeRoles(['admin']);

        if ($user->hasRole($role->name)) {
            $user->roles()->detach($role);

            $user->save();
        }

        return redirect()->action('UserController@index');
    }
}
