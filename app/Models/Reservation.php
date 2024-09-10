<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'catalog_id','student_id','duration','status',
        'info'
    ];

    function catalog() {
        return $this->belongsTo(Catalog::class);
    }

    function student() {
        return $this->belongsTo(Student::class);
    }
}
