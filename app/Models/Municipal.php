<?php

namespace App\Models;

use App\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Municipal extends Model
{
    use HasFactory;

    protected $table = 'municipals';
    protected $primaryKey = 'id';
    protected $fillable = ['psgcCode', 'citymunDesc', 'regCode', 'provCode', 'citymunCode'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'id');
    }
}
