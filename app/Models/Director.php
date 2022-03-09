<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    // define relationship director and movie
    public function movies(){
        $this->hasMany(Movie::class);
    }
}
