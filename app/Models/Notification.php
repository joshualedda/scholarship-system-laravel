<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Notification extends Model
{
    use HasFactory, Notifiable;

    // Define relationships (if applicable)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = 
    [
        'user_id',
        'data',
        'read_at'
    ];
    // Define other relationships as needed

    // Customize broadcast channel (optional)
    public function broadcastOn()
    {
        return config('broadcasting.connections.pusher'); // Adjust as needed
    }
}
