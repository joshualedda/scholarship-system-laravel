<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = "students";
    protected $fillable = [
        'student_id',
        'lastname',
        'firstname',
        'initial',
        'email',
        'sex',
        'status',
        'barangay',
        'municipal',
        'province',
        'campus',
        'course',
        'level',
        'father',
        'mother',
        'contact',
        'studentType',
        'nameSchool',
        'lastYear',
        'student_status'
    ];

    public function campus()
    {
        return $this->belongsTo(Campus::class, 'id');
    }

    public function course()
    {
        return $this->hasMany(Course::class, 'course_id');
    }

    public function barangay()
    {
        return $this->hasMany(Barangay::class, 'barangay', 'brgyCode');
    }

    public function municipal()
    {
        return $this->hasMany(Municipal::class, 'municipal', 'citymunCode');
    }

    public function province()
    {
        return $this->hasMany(Province::class, 'province', 'provCode');
    }

    public function scholarshipName()
    {
        return $this->belongsTo(ScholarshipName::class);
    }

    public function grantee()
    {
        return $this->hasOne(Grantee::class, 'student_id');
    }

    public function grantees()
    {
        return $this->hasMany(Grantee::class);
    }
    public function studentGrantee()
    {
        return $this->hasMany(StudentGrantee::class);
    }
    public function getStatusTextAttribute()
    {
        $value = $this->attributes['student_status'];
        switch ($value) {
            case 0:
                return 'Active';
            case 1:
                return 'Inactive';
            default:
                return 'No info';
        }
    }
    public function getTextAttribute()
    {
        $value = $this->attributes['scholarship_type'] ??  null;
        switch ($value) {
            case 0:
                return 'Government';
            case 1:
                return 'Private';
            default:
                return 'No info';
        }
    }

}
