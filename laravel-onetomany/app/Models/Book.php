<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    protected $fillable = ["title", "author_id"];
    use HasFactory;

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
