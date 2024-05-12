<?php

namespace App\Livewire;

use App\Models\Campus;
use App\Models\Course;
use App\Models\Grantee;
use App\Models\Student;
use Livewire\Component;
use App\Models\AuditLog;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Traits\Variables;
use App\Models\SchoolYear;
use App\Models\Notification;
use App\Models\ScholarshipName;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class StudentEdit extends Component
{
    use Variables;
    public $studentId, $student, $scholarship_name, $scholarship_type;
    public $noStudentRecord = false;
    public $existingStudent;
    public $fundSources1;
    public $fundSources2;
    public $scholarshipsCreated;

    public $semester2;
    public $school_year2;

    protected $rules = [
        'student_id' => 'required',
        'semester' => 'required',
        'school_year' => 'required',
        'semester2' => 'required',
        'school_year2' => 'required',
        'selectedScholarshipType1' => 'required_without:selectedScholarshipType2',
        'selectedfundsources1' => 'required_with:selectedScholarshipType1',
        'selectedScholarshipType2' => 'required_without:selectedScholarshipType1',
        'selectedfundsources2' => 'required_with:selectedScholarshipType2',
    ];

    public function fetchSchoolYears()
    {
        $this->years = SchoolYear::orderBy('school_year', 'desc')->limit(8)->get();
    }

    public function mount($rowId)
    {
        $this->student = $rowId;
        // Load the student details based on $rowId
        $this->student = Student::findOrFail($rowId);

        $this->student_id = $this->student->student_id;
        $this->lastname= $this->student->lastname;
        $this->firstname= $this->student->firstname;
        $this->initial= $this->student->initial;
        $this->email= $this->student->email;
        $this->sex= $this->student->sex;
        $this->status= $this->student->status;

        // Use join to get the related models
        $this->selectedBarangay =  $this->student->barangay;
        $this->selectedMunicipality = $this->student->municipal;
        $this->selectedProvince = $this->student->province;

        $this->selectedCampus = Campus::join('students', 'campuses.id', '=', 'students.campus')
            ->where('students.id', $this->student->id)
            ->value('campusDesc') ?? "No data";

        $this->selectedCourse = Course::join('students', 'courses.course_id', '=', 'students.course')
            ->where('students.id', $this->student->id)
            ->value('course_name') ?? "No data";

        $this->selectedBarangay = Barangay::join('students', 'barangays.brgyCode', '=', 'students.barangay')
            ->where('students.id', $this->student->id)
            ->value('brgyDesc') ?? "No data";

        $this->selectedMunicipality = Municipal::join('students', 'municipals.citymunCode', '=', 'students.municipal')
            ->where('students.id', $this->student->id)
            ->value('citymunDesc') ?? "No data";

        $this->selectedProvince = Province::join('students', 'provinces.provCode', '=', 'students.province')
            ->where('students.id', $this->student->id)
            ->value('provDesc') ?? "No data";

        $this->level= $this->student->level;
        $this->father= $this->student->father;
        $this->mother= $this->student->mother;
        $this->contact= $this->student->contact;
        $this->studentType= $this->student->studentType;
        $this->nameSchool = $this->student->nameSchool ?? "No data";
        $this->lastYear= $this->student->lastYear ?? "No data";

        $grantees = Grantee::where('student_id', $rowId)->get();

        if ($grantees->isNotEmpty()) {
            $this->school_year = $grantees->first()->school_year;
            $this->semester = $grantees->first()->semester;
            $this->selectedScholarshipType1 = $grantees->first()->scholarship_type;
            $this->selectedfundsources1 = $grantees->first()->scholarship_name;

            if ($grantees->count() > 1) {
                $secondGrantee = $grantees[1];
                $this->school_year2 = $secondGrantee->school_year;
                $this->semester2 = $secondGrantee->semester;
                $this->selectedScholarshipType2 = $secondGrantee->scholarship_type;
                $this->selectedfundsources2 = $secondGrantee->scholarship_name;
            } else {
                // Set default values when there's only one or no grantees
                $this->school_year2 = null;
                $this->semester2 = null;
                $this->selectedScholarshipType2 = null;
                $this->selectedfundsources2 = null;
            }
        } else {
            // Set default values when there are no grantees
            $this->school_year = "No data";
            $this->semester = "No data";
            $this->school_year2 = "No data";
            $this->semester2 = "No data";
            $this->selectedScholarshipType1 = "No data";
            $this->selectedfundsources1 = "No data";
            $this->selectedScholarshipType2 = "No data";
            $this->selectedfundsources2 = "No data";
        }
    }


        public function updatedSelectedScholarshipType1($value)
        {
            $this->fundSources1 = ScholarshipName::where('scholarship_type', $value)
                ->where('status', 0)
                ->get();
        }
        public function updatedSelectedScholarshipType2($value)
        {
            $this->fundSources2 = ScholarshipName::where('scholarship_type', $value)
                ->where('status', 0)
                ->get();
        }



    public function studentSearch()
    {
        $this->existingStudent = null; // Reset student data initially
        $this->noStudentRecord = false; // Reset error flag

        $studentId = $this->student_id;

        // Perform the student search logic based on the role and campus restrictions:
        if (auth()->user()->role === 0 || auth()->user()->role === 1) {
            $this->existingStudent = Student::with('grantees')
                ->where('student_id', $studentId)
                ->first();
        } else {
            $this->existingStudent = Student::with('grantees')
                ->where('student_id', $studentId)
                ->where('campus', 1)
                ->first();

            // Add validation for users with roles other than 0 or 1
            if ($this->existingStudent && $this->existingStudent->campus !== 1) {
                // Handle the error or add your custom logic
                $error = 'Access Denied!';
                session()->flash('error', $error);
            }
        }

        if (!$this->existingStudent) {
            $this->noStudentRecord = true;
        } else {
            // If a student is found, display sample data:
            $this->lastname = $this->existingStudent->lastname;
            $this->firstname = $this->existingStudent->firstname;
            $this->initial = $this->existingStudent->initial;
            $this->sex = $this->existingStudent->sex;
            $this->status = $this->existingStudent->status;
            $this->email = $this->existingStudent->email;
            $this->contact = $this->existingStudent->contact;

            $this->selectedCampus = Campus::join('students', 'campuses.id', '=', 'students.campus')
                ->where('students.id', $this->existingStudent->id)
                ->value('campusDesc') ?? "No data";
            $this->selectedCourse = Course::join('students', 'courses.course_id', '=', 'students.course')
                ->where('students.id', $this->existingStudent->id)
                ->value('course_name') ?? "No data";

            $this->studentType = $this->existingStudent->studentType;
            $this->nameSchool = $this->existingStudent->nameSchool ?? "No Data";
            $this->lastYear = $this->existingStudent->lastYear ?? "No Data";

            $this->selectedBarangay = Barangay::join('students', 'barangays.brgyCode', '=', 'students.barangay')
            ->where('students.id', $this->student->id)
            ->value('brgyDesc') ?? "No data";
            $this->selectedMunicipality = Municipal::join('students', 'municipals.citymunCode', '=', 'students.municipal')
            ->where('students.id', $this->student->id)
            ->value('citymunDesc') ?? "No data";
            $this->selectedProvince = Province::join('students', 'provinces.provCode', '=', 'students.province')
            ->where('students.id', $this->student->id)
            ->value('provDesc') ?? "No data";

            $this->level = $this->existingStudent->level;
            $this->father = $this->existingStudent->father;
            $this->mother = $this->existingStudent->mother;

            $grantees = $this->existingStudent->grantees;  // Retrieve all grantees at once

            if ($grantees->isNotEmpty()) {

                $this->school_year = $grantees->first()->school_year;
                $this->semester = $grantees->first()->semester;

                $this->selectedScholarshipType1 = $grantees->first()->scholarship_type;
                $this->selectedfundsources1 = $grantees->first()->scholarship_name;

                if ($grantees->count() > 1) {
                    $secondGrantee = $grantees->get(1);
                    $this->school_year2 = $secondGrantee->school_year;
                    $this->semester2 = $secondGrantee->semester;
                    $this->selectedScholarshipType2 = $secondGrantee->scholarship_type;
                    $this->selectedfundsources2 = $secondGrantee->scholarship_name;
              } else {
                // Set default values when there's only one or no grantees
                $this->school_year2 = null;
                $this->semester2 = null;
                $this->selectedScholarshipType2 = null;
                $this->selectedfundsources2 = null;
            }
        } else {
            // Set default values when there are no grantees
            $this->school_year = null; // or provide a default value
            $this->semester = null;
            $this->school_year2 = null; // or provide a default value
            $this->semester2 = null;
            $this->selectedScholarshipType1 = null;
            $this->selectedfundsources1 = null;
            $this->selectedScholarshipType2 = null;
            $this->selectedfundsources2 = null;
              }

            }


    }

    public function render()
    {

     $this->fetchSchoolYears();
             // Fetch provinces from the database
             $this->provinces = Province::where('regCode', 01)->get();

             // Fetch municipalities based on the selected province
             if ($this->selectedProvince) {
                 $this->municipalities = Municipal::where('provCode', $this->selectedProvince)->get();
             } else {
                 $this->municipalities = [];
             }

             // Fetch barangays based on the selected municipality
             if ($this->selectedMunicipality) {
                 $this->barangays = Barangay::where('citymunCode', $this->selectedMunicipality)->get();
             } else {
                 $this->barangays = [];
             }

             $this->fundSources1 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType1)
             ->where('status', 0)
             ->get();

             $this->fundSources2 = ScholarshipName::where('scholarship_type', $this->selectedScholarshipType2)
             ->where('status', 0)
             ->get();

        return view('livewire.student-edit',[
            'years' => $this->years,
            'fundSources1' => $this->fundSources1,
            'fundSources2' => $this->fundSources2,
            'student' => $this->student,
            'existingStudent' => $this->existingStudent,
            'noStudentRecord' => $this->noStudentRecord,
            'provinces' => $this->provinces,
        ])->extends('layouts.includes.index')
          ->section('content');
    }


    public function addScholarship()
    {
        $this->validate();
        
// Check if the first scholarship already exists based on type
$firstScholarshipExists = Grantee::where('student_id', $this->student->id)
    ->where('scholarship_type', $this->selectedScholarshipType1)
    ->exists();

// If the first scholarship doesn't exist, insert it
if (!$firstScholarshipExists) {
    Grantee::create([
        'student_id' => $this->student->id,
        'school_year' => $this->school_year,
        'semester' => $this->semester,
        'scholarship_type' => $this->selectedScholarshipType1,
        'scholarship_name' => $this->selectedfundsources1,
    ]);
}

// Check if the second scholarship already exists based on type
$secondScholarship = Grantee::where('student_id', $this->student->id)
    ->where('scholarship_type', $this->selectedScholarshipType2)
    ->first();

// If the second scholarship exists, update its data
if ($secondScholarship) {
    $secondScholarship->update([
        'semester' => $this->semester2 ?? $secondScholarship->semester,
        'school_year' => $this->school_year2 ?? $secondScholarship->school_year,
        'scholarship_type' => $this->selectedScholarshipType2 ?? $secondScholarship->scholarship_type,
        'scholarship_name' => $this->selectedfundsources2 ?? $secondScholarship->scholarship_name,
    ]);
} else {
    // If the second scholarship doesn't exist, insert its essential data
    Grantee::create([
        'student_id' => $this->student->id,
        'semester' => $this->semester2 || null,
        'school_year' => $this->school_year2 || null,
        'scholarship_type' => $this->selectedScholarshipType2 || null,
        'scholarship_name' => $this->selectedfundsources2 || null,
    ]);
}


    
        // Create a notification
        Notification::create([
            'user_id' => auth()->id(),
            'data' => 'New scholarship(s) added for ' . $this->student->name,
        ]);
    
        // Log the action
        $scholarshipData = [
            'First Scholarship' => [
                'school_year' => $this->school_year,
                'semester' => $this->semester,
                'type' => $this->selectedScholarshipType1,
                'name' => $this->selectedfundsources1,
            ],
        ];
        if ($secondScholarship) {
            $scholarshipData['Second Scholarship'] = [
                'school_year' => $this->school_year2,
                'semester' => $this->semester2,
                'type' => $this->selectedScholarshipType2,
                'name' => $this->selectedfundsources2,
            ];
        }
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'Added scholarship(s) for ' . $this->student->name,
            'data' => json_encode($scholarshipData),
        ]);
    
        // Display appropriate success message
        session()->flash('success', 'Scholarships added successfully!');
    }
    
    
    
    
        
    







}
