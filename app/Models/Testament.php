<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testament extends Model
{
    //Relationships.
    public function books () {
        return $this->hasMany(Book::class);
    }
}
