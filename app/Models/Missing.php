<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Missing extends Model
{
    use HasFactory;

    protected $fillable = [
        'reserved_id','student_id','status'
    ];

    function reserved() {
        return $this->belongsTo(Reserved::class);
    }

    function student() {
        return $this->belongsTo(Student::class);
    }
}
