<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Highlight extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The relationships.
     */
    public function user () {
        return $this->belongsTo(User::class);
    }

    public function verse () {
        return $this->belongsTo(Verse::class);
    }
}
