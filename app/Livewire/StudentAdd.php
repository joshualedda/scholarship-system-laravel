<?php

namespace App\Livewire;

use Exception;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class StudentAdd extends Component
{

    use WithFileUploads;

    public $csv_file;

    public function rules()
    {
        return [
            'csv_file' => 'required|file|mimes:csv,txt',
        ];
    }

    public function customMessages()
    {
        return [
            'csv_file.required' => 'Please select a CSV file to import.',
            'csv_file.file' => 'The file must be a valid file.',
            'csv_file.mimes' => 'Only CSV or TXT files are allowed.',
        ];
    }

    public function import()
    {
        $validatedData = $this->validate();

        try {
            Excel::import(new StudentImport, $validatedData['csv_file']);

            $this->reset('csv_file');
            session()->flash('success', 'Students imported successfully!');
        } catch (Exception $e) {
            session()->flash('error', 'An error occurred during import: ' . $e->getMessage());
        }
    }





    public function render()
    {
        return view('livewire.student-add')
        ->extends('layouts.includes.index')
        ->section('content');
    }
}
