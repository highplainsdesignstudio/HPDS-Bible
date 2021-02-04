<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verse extends Model
{
    // Relationships.
    public function chapter () {
        return $this->belongsTo(Chapter::class);
    }
}
