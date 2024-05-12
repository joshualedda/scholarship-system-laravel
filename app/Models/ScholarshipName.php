<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipName extends Model
{
    protected $table = 'scholarship_name';
    protected $primaryKey = 'id';
    protected $fillable =
    [
            'name',
            'scholarship_type',
            'status'
    ];


    public function getTypeScholarshipNameAttribute()
    {
        $value = optional($this->grantee)->scholarship_type;
        switch ($value) {
            case 0:
                return 'Government';
            case 1:
                return 'Private';
            default:
                return 'No info';
        }
    }

    public function getTypeScholarshipAttribute()
    {
        $value = $this->attributes['scholarship_type'];
        switch ($value) {
            case 0:
                return 'Government';
            case 1:
                return 'Private';
            default:
                return 'No info';
        }
    }
    public function getStatusScholarshipNameAttribute()
    {
        $value = $this->attributes['status'];
        switch ($value) {
            case 0:
                return 'Active';
            case 1:
                return 'Inactive';
            default:
                return 'No info';
        }
    }
}
