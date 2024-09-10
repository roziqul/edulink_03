<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover','section_id','category_id','title',
        'writer','publisher','release_year','price','status',
    ];

    function classification() {
        return $this->belongsTo(bookClassification::class);
    }

    function category() {
        return $this->belongsTo(Category::class);
    }

    function serials() {
        return $this->hasMany(Serial::class);
    }

}
