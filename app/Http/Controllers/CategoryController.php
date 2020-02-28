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
        Auth::user()->authorizeRoles(['admin']);

        $category = new Category;
        $category->name = $request->nombre;
       
        $category->save();

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
        Auth::user()->authorizeRoles(['admin']);

        $category->name = $request->nombre;
       
        $category->save();

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
        Auth::user()->authorizeRoles(['admin']);

        $category->delete();

        return redirect()->action('PostController@index');
    }
}
