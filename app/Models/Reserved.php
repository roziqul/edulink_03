<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserved extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_id','student_id','duration',
        'start_date','due_date','return_date',
        'overdue','total_bill','bill_status',
        'rsv_status','info','verified_by'
    ];

    function serial() {
        return $this->belongsTo(Serial::class);
    }

    function student() {
        return $this->belongsTo(Student::class);
    }

    function admin() {
        return $this->belongsTo(User::class);
    }
}
