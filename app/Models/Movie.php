<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = ["title","poster_url","synopsis","video_url","year","director_id","category_id"];




    public function movie(){
        $this->belongsTo(Category::class);
    }

    public function actors(){
        $this->belongsToMany(Actor::class);
    }

    // define relationship director and movie
    public function director(){
        $this->belongsTo(Director::class);
    }

    //movie_user -> this is the default
    //We want to overide the table name
    //We use the second parameter, to overide the default table name
    public function favourites(){
        $this->belongsToMany(User::class, 'movie_user_fav');
    }

    public function bookmarks(){
        $this->belongsToMany(User::class, 'movie_user_bookmark');
    }
}
