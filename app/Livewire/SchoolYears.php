<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SchoolYear;

class SchoolYears extends Component
{
    public $year;
    public function render()
    {
        return view('livewire.school-year')
        ->extends('layouts.includes.index')
        ->section('content');
    }

    public function addYear()
    {
        $this->validate([
            'year' => 'required|string|regex:/^\d{4}-\d{4}$/'
        ]);

        try {
            // Assuming a SchoolYear model exists for database interaction
            SchoolYear::create([
                'school_year' => $this->year
            ]);

            // Reset form fields after successful submission
            $this->reset('year');

            // Display a success message
            session()->flash('success', 'School year added successfully!');

            // Optionally redirect to a different page or reload the current page
            // return redirect()->to('/school-years');
        } catch (\Exception $e) {
            // Handle database errors gracefully
            $this->addError('general_error', 'An error occurred while adding the school year. Please try again.');
        }
    }

    
}
