<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo','nisn','class',
        'fullname','pob','dob',
        'gender','address','phone'
    ];

    function reservations() {
        return $this->hasMany(Reservation::class);
    }

    function reserveds() {
        return $this->hasMany(Reserved::class);
    }
}
