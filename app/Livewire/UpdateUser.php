<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateUser extends Component
{
    public $userId, $user_id, $confirmPass;
    public $user;
    public $name;
    public $username;
    public $email;
    public $role;
    public $password;

    public function mount($userId)
    {
        $this->user = User::find($userId);
        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->role = $this->user->role;
    }

    public function updateUser()
    {

        // $rules = [
        //     'name' => 'string|max:255',
        //     'username' => 'string|max:255|unique:users,username,' . $this->user->id,
        //     'email' => 'string|email|max:255|unique:users,email,' . $this->user->id,
        //     'role' => 'in:1,0,2',
        //     'password' => 'nullable|min:8|confirmed',
        // ];
        // $this->validate($rules);

        $originalData = $this->user->toArray();

        $data = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'role' => $this->role,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $this->user->update($data);

        // $updatedData = array_diff_assoc($data, $originalData);

        // $action = 'Updated: ';
        // foreach ($updatedData as $key => $value) {
        //     $action .= $key . ' from ' . $originalData[$key] . ' to ' . $value . ', ';
        // }
        // $action = rtrim($action, ', ');

        $user = Auth::user();
        AuditLog::create([
            'user_id' => $user->id,
            'action' => json_encode('Updated data'),
            'data' => json_encode('Updated by ' . $user->name),
        ]);

        session()->flash('success', 'User updated successfully!');
    }

    public function render()
    {
        return view('livewire.update-user')->extends('layouts.includes.index')
        ->section('content');

    }
}
