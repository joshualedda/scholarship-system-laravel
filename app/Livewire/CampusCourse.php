<?php

namespace App\Livewire;

use App\Models\Campus;
use App\Models\Course;
use Livewire\Component;

class CampusCourse extends Component
{
    public $campus, $campusDesc, $campus_select, $course_program; 
    public $editCampus, $editCampusDesc, $editCampusId;


    public function campusAdd()
{
    $this->validate([
        'campus' => 'required|string|max:255',
        'campusDesc' => 'required|string',
    ]);

    try {
        // Assuming a Campus model exists for database interaction
        $campused = Campus::create([
            'campus_name' => $this->campus,
            'campusDesc' => $this->campusDesc
        ]);

        // Reset form fields after successful submission
        $this->reset(['campus', 'campusDesc']);

        // Display a success message
        session()->flash('success', 'Campus added successfully!');

        // Optionally redirect to a different page or reload the current page
        // return redirect()->to('/campuses');
    } catch (\Exception $e) {
        // Handle database errors gracefully
        $this->addError('general_error', 'An error occurred while adding the campus. Please try again.');
    }

    
}

    public function courseAdd()
    {
        $this->validate([
            'campus_select' => 'required|integer|exists:campuses,id',
            'course_program' => 'required|string|max:255',
        ]);

        try {
            // Assuming a Course model exists for database interaction
            $course = Course::create([
                'campus_id' => $this->campus_select,
                'course_name' => $this->course_program
            ]);

            // Reset form fields after successful submission
            $this->reset(['campus_select', 'course_program']);

            // Display a success message
            session()->flash('success', 'Course/Program added successfully!');

            // Optionally redirect to a different page or reload the current page
            // return redirect()->to('/courses');
        } catch (\Exception $e) {
            // Handle database errors gracefully
            $this->addError('general_error', 'An error occurred while adding the course/program. Please try again.');
        }
    }
   

    // Function to update campus details
    public function updateCampus()
    {
        // $this->validate([
        //     'editCampus' => 'required|string|max:255',
        //     'editCampusDesc' => 'required|string',
        // ]);

        try {
            // Find the campus by ID
            $campus = Campus::findOrFail($this->editCampusId);

            // Update campus details
            $campus->update([
                'campus_name' => $this->editCampus,
                'campusDesc' => $this->editCampusDesc
            ]);

            // Close the modal
            $this->emit('closeModal');

            // Display success message
            session()->flash('success', 'Campus details updated successfully!');
        } catch (\Exception $e) {
            // Handle errors
            session()->flash('error', 'An error occurred while updating campus details. Please try again.');
        }
    }
public function render()
{
        if(auth()->user()->role === 1 || auth()->user()->role === 0)
        {
            $campuses = Campus::all();
        }else{
            $campuses = Campus::where('id', 1);
        }

        return view('livewire.campus-course',[
            'campuses' =>$campuses,
        ])->extends('layouts.includes.index')
        ->section('content');
    }
}
