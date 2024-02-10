<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['code', 'title'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
