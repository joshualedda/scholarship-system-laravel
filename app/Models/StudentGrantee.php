<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrantee extends Model
{
    use HasFactory;
    protected $table = 'student_grantee';

    protected $fillable =  [
        'student_id',
        'scholarship_type',
        'scholarship_name'
    ];
}
