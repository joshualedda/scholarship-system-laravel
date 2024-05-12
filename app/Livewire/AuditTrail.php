<?php

namespace App\Livewire;

use Livewire\Component;

class AuditTrail extends Component
{
    public function render()
    {
        return view('livewire.audit-trail')
        ->extends('layouts.includes.index')
        ->section('content');
    }
}
