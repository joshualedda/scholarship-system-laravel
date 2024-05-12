<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AuditLog;
use App\Models\ScholarshipName;
use Illuminate\Support\Facades\Auth;

class ScholarView extends Component
{
    // public $scholarships;
    public $scholarship_type_id;
    public $scholarship_name;
    public $status;
    public $scholarship_type_filter = 0;
    public $status_filter = null;

    public function mount()
    {
        $this->scholarship_type_filter = request()->query('scholarship_type', 0); // Retrieve from URL
        $this->status_filter = request()->query('status');
    }


    public function addScholarship()
    {
        $this->validate([
            'scholarship_name' => 'required|string|max:255',
            'scholarship_type_id' => 'required|in:0,1',
        ]);

        ScholarshipName::create([
            'name' => $this->scholarship_name,
            'scholarship_type' => $this->scholarship_type_id,
        ]);
        
        session()->flash('success', 'Created successfully!');
        $user = Auth::user();
        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Added: '. $this->scholarship_name,
            'data' => json_encode('Added by '. $user->name),
        ]);
    }

    public function render()
    {
        $scholarships = ScholarshipName::orderBy('name', 'asc')
            ->when($this->scholarship_type_filter !== 0, function ($query) {
                $query->where('scholarship_type', $this->scholarship_type_filter);
            })
            ->when($this->status_filter !== null, function ($query) {
                $query->where('status', $this->status_filter);
            })
            ->get();

            return view('livewire.scholar-view', [
            'scholarships' => $scholarships,
        ])
        ->extends('layouts.includes.index')
        ->section('content');
    }


}
