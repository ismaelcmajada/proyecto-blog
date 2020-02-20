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

    public function verifyAuthor(User $user) 
    {
        if(!$user->hasRole('admin')) {
            abort_unless($this->author_id == $user->author->id, 401);
        }
        return true;
    }
}


