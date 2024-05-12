<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Notification;

class NotificationsDropdown extends Component
{
    public $notifications;

    public function mount()
    {
        $this->notifications = Notification::where('user_id', auth()->id())
            ->whereDate('created_at', Carbon::today())
            ->groupBy('data')
            ->selectRaw('count(*) as count, data')
            ->get();
    }

    public function render()
    {
        return view('livewire.notifications-dropdown');
    }
}
