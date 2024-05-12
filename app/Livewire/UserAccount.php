<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;

class UserAccount extends Component
{

    public $users;
    
    public function render()
    {
        $this->users = User::all();
        return view('livewire.user-account')->extends('layouts.includes.index')
        ->section('content');
    }


}
