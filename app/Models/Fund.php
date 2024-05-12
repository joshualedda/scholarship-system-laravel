<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{

    protected $fillable = ['student_id', 'source_id', 'campus', 'schoolYear'];

    // Define the relationship between Fund and Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    // Define the relationship between Fund and FundSource
    // public function fundSource()
    // {
    //     return $this->belongsTo(FundSource::class);
    // }

}
