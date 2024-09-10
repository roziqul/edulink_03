<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{
    use HasFactory;

    protected $fillable = [
        'catalog_id','registration_number','status','student_id'
    ];

    function catalog() {
        return $this->belongsTo(Catalog::class);
    }

    function student() {
        return $this->belongsTo(Student::class);
    }
}
