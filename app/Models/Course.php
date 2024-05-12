<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'course_id';

    protected $fillable =
    [
        'course_name',
        'campus_id',
    ];

    public function campus()
{
    return $this->belongsTo(Campus::class, 'campus_id');
}

}
