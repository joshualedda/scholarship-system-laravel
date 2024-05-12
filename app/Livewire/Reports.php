<?php

namespace App\Livewire;

use App\Models\Campus;
use App\Models\Student;
use Livewire\Component;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Traits\Variables;
use App\Models\SchoolYear;
use App\Exports\StudentExport;
use App\Models\ScholarshipName;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Reports extends Component
{
    use Variables;

    public $campuses, $selectedScholarshipType, $selectedfunsources, $fundsources, $filteredStudents;

    public function mount()
    {
        $this->provinces = Province::where('regCode', 01)->get();
        $this->fundsources = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType)
        ->where('status', 0)
        ->get();

    }

    public function updatedSelectedScholarshipType($value)
    {
        $this->fundsources = ScholarshipName::where('scholarship_type', $value)
        ->where('status', 0)
        ->get();
    }

    public function updatedSelectedProvince($provinceId)
    {
        if ($provinceId) {
            $this->municipalities = Municipal::where('provCode', $provinceId)->get();
            $this->selectedMunicipality = null; // Reset municipality and barangay
            $this->barangays = [];
        } else {
            $this->municipalities = [];
            $this->selectedMunicipality = null;
            $this->barangays = [];
        }
    }

    public function updatedSelectedMunicipality($municipalityId)
    {
        if ($municipalityId) {
            $this->barangays = Barangay::where('citymunCode', $municipalityId)->get();
        } else {
            $this->barangays = [];
        }
    }
    public function fetchSchoolYears()
    {
        $this->years = SchoolYear::orderBy('school_year', 'asc')->limit(5)->get();
    }

    public function export()
    {
    $students = $this->gatherData();

    // Export the data to Excel using Laravel Excel
    return Excel::download(new StudentExport($students), 'Report.xlsx');
    }

    public function gatherData()
    {
            // Validate school year and semester on mount
            $this->validate([
                'selectedYear' => 'required',
                'semester' => 'required',
            ]);
        $query = Student::query();

        // Join with grantees table using the correct relationship name
        $query->join('grantees', 'students.id', '=', 'grantees.student_id');
        // Join with tables for name retrieval
        $query->join('barangays', 'students.barangay', '=', 'barangays.brgyCode');
        $query->join('municipals', 'students.municipal', '=', 'municipals.citymunCode');
        $query->join('provinces', 'students.province', '=', 'provinces.provCode');
        $query->join('campuses', 'students.campus', '=', 'campuses.id');
        $query->join('courses', 'students.course', '=', 'courses.course_id');
        // Join with scholarships table to retrieve scholarship names
        $query->join('scholarship_name',  'grantees.scholarship_name', '=', 'scholarship_name.id');

        // Apply filtering based on selected options
        if ($this->selectedProvince) {
            $query->where('students.province', $this->selectedProvince);
        }
        if ($this->selectedMunicipality) {
            $query->where('students.municipal', $this->selectedMunicipality);
        }
        if ($this->selectedBarangay) {
            $query->where('students.barangay', $this->selectedBarangay);
        }

        // Apply filtering based on selected options
        if ($this->selectedCampus) {
            $query->where('students.campus', $this->selectedCampus);
        }
        if ($this->selectedCourse) {
            $query->where('students.course', $this->selectedCourse);
        }

        if ($this->semester) {
            $query->where('grantees.semester', $this->semester);
        }

        if ($this->selectedYear) {
            $query->where('grantees.school_year', $this->selectedYear);
        }

        if ($this->selectedScholarshipType) {
            $query->where('grantees.scholarship_type', $this->selectedScholarshipType);
        }

        if ($this->selectedfunsources) {
            $query->where('grantees.scholarship_name', $this->selectedfunsources);
        }

        $selectedFields = [
            DB::raw('CONCAT(students.lastname, ", ", students.firstname, " ", students.initial) AS full_name')
        ];

        if ($this->selectedProvince) {
            $selectedFields[] = 'provinces.provDesc as provDesc';
        }

        if ($this->selectedMunicipality) {
            $selectedFields[] = 'municipals.citymunDesc as citymunDesc';
        }

        if ($this->selectedBarangay) {
            $selectedFields[] = 'barangays.brgyDesc as brgyDesc';
        }

        if ($this->selectedCampus) {
            $selectedFields[] = 'campuses.campus_name as campus_name';
        }

        if ($this->selectedCourse) {
            $selectedFields[] = 'courses.course_name as course_name';
        }

        if ($this->semester) {
            $selectedFields[] = 'grantees.semester';
        }

        if ($this->selectedYear) {
            $selectedFields[] = 'grantees.school_year';
        }

        if ($this->selectedfunsources) {
            $selectedFields[] = 'scholarship_name.name as scholarship_name';
        }

        if ($this->selectedScholarshipType) {
            $selectedFields[] = 'grantees.scholarship_type';
        }

        $query->select($selectedFields);

        return $query->distinct()->get();
    }




    public function render()
    {

        $this->fetchSchoolYears();

        if (auth()->user()->role === 0 || auth()->user()->role === 1) {
            $this->campuses = Campus::all();
        } else {
            $this->campuses = Campus::where('id', 1)->get();
        }
        if ($this->selectedCampus) {
            $campus = Campus::findOrFail($this->selectedCampus);
            $this->courses = $campus->courses;
        } else {
            $this->courses = [];
        }

        return view('livewire.reports',[
            'years' => $this->years,
            'fundsources' => $this->fundsources,
            'provinces' => $this->provinces,
        ])->extends('layouts.includes.index')
        ->section('content');
    }
}
