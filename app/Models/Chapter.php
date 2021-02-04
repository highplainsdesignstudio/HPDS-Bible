<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    // Relationships.
    public function book () {
        return $this->belongsTo(Book::class);
    }

    public function verses () {
        return $this->hasMany(Verse::class);
    }
}
