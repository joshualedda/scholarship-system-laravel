<?php

namespace App\Models;

use App\Http\Livewire\AuditTrail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $table = 'audit_trail';
    protected $fillable = ['user_id', 'action', 'data'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
