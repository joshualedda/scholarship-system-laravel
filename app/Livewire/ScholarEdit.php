<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AuditLog;
use App\Models\ScholarshipName;
use Illuminate\Support\Facades\Auth;

class ScholarEdit extends Component
{
    public $scholarship_type_id, $scholarship_type;
    public $scholarship_name,$name;
    public $status;
    public $scholarName;
    public function mount($scholar)
    {
        $this->scholarName = ScholarshipName::find($scholar);
        $this->scholarship_name = $this->scholarName->name;
        $this->scholarship_type_id = $this->scholarName->scholarship_type;
        $this->status = $this->scholarName->status;
    }

    protected $rules = [
        'scholarship_name' => 'string|max:255',
        'scholarship_type_id' => 'in:0,1',
        'status' => 'in:0,1',
    ];

    public function updateScholar()
    {
        $this->validate();

        $data = [
            'name' => $this->scholarship_name,
            'scholarship_type' => $this->scholarship_type_id,
            'status' => $this->status,
        ];
        $this->scholarName->update($data);
        session()->flash('success', 'Updated successfully!');
        $user = Auth::user();
        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Updated '. $this->scholarship_name,
            'data' => json_encode('Updated by '. $user->name),
        ]);

    }


    public function render()
    {
        return view('livewire.scholar-edit')
        ->extends('layouts.includes.index')
        ->section('content');
    }
}
