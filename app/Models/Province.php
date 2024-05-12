<?php

namespace App\Models;

use App\Models\Region;
use App\Models\Municipal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;
    protected $table = 'provinces';
    protected $primaryKey = 'id';
    protected $fillable = ['psgcCode', 'provDesc', 'regCode' , 'provCode'];

    public function region()
    {
        return $this->belongsTo(Region::class, 'id');
    }
    public function municipals()
    {
        return $this->hasMany(Municipal::class, 'provCode');
    }
}
