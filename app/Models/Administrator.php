<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'email',
        'nip',
        'fullname',
        'pob',
        'dob',
        'gender',
        'address',
        'phone',
        'role'
    ];
}
