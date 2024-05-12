<?php

namespace App\Models;
use App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{

    protected $table = 'campuses';

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    protected $fillable = ['campus_name', 'campusDesc'];



}
