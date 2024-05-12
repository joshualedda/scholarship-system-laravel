<?php

namespace App\Livewire;

use Livewire\Component;

class ViewGrantee extends Component
{

    public function render()
    {
        return view('livewire.view-grantee')
        ->extends('layouts.includes.index')
        ->section('content');
    }
}
