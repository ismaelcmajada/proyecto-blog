<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {

        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['admin']);

        //Guardamos el nuevo registro.

        $category = new Category;
        $category->name = $request->nombre;
       
        $category->save();

        //Devolvemos la vista

        return redirect()->action('PostController@index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, Category $category)
    {
        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['admin']);

        //Modificamos los campos del registro.

        $category->name = $request->nombre;
       
        $category->save();

        //Devolvemos la vista.

        return redirect()->action('PostController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //Autorizamos a los usuarios con los roles especificados.

        Auth::user()->authorizeRoles(['admin']);

        //Eliminamos el registro.

        $category->delete();

        //Devolvemos la vista.

        return redirect()->action('PostController@index');
    }
}
