<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    //Con este método buscamos comprobar que el usuario pasado por parátro sea el autor del post
    public function verifyAuthor(User $user) 
    {
        if(!$user->hasRole('admin')) { //Si el usuario pasado es admin, se evita la comprobación
            abort_unless($this->author_id == $user->author->id, 401); //En caso de que no lo sea, abortamos y devolvemos un código 401.
        }
        return true;
    }
}


