<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Campus;
use App\Models\UserType;
use Livewire\Component;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AddUser extends Component
{
    public $name, $username, $email, $role, $password, $campus, $campuses, $userTypes;
    public function addUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:1,0,2',
            'password' => 'required|string|min:8',
            'campus' => $this->role == 2 ? 'required|string|max:255' : '', // Only required if role is Campus In-charge
        ]);

        // Set campus to 0 by default if role is not Campus In-charge
        if ($this->role != 2) {
            $this->campus = 0;
        }

        User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role,
            'campus' => $this->campus,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('success', 'User created successfully!');
        $user = Auth::user();
        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Added: ' . $this->name,
            'data' => json_encode('Added by ' . $user->name),
        ]);

        $this->reset();
    }

    public function render()
    {
        $this->campuses = Campus::all();
        $this->userTypes = UserType::where('status', 0)->get();

        return view('livewire.add-user')
        ->extends('layouts.includes.index')
        ->section('content');
    }
}
