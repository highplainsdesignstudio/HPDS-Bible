<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //Relationships.
    public function testament () {
        return $this->belongsTo(Testament::class);
    }

    public function chapters () {
        return $this->hasMany(Chapter::class);
    }

}
