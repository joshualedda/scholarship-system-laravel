<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Course;
use App\Models\Student;
use App\Models\Barangay;
use App\Models\Province;
use App\Models\Municipal;
use App\Traits\Variables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EditStudentController extends Controller
{

    use Variables;

    // edit form
 

    public function edit(Student $rowId)
{
    $student = $rowId;

    // Fetch provinces from the database
    $provinces = Province::where('regCode', 01)->get();

    // Fetch municipalities based on the selected province
    $municipalities = Municipal::where('provCode', $student->province_code)->get();

    // Fetch barangays based on the selected municipality
    $barangays = Barangay::where('citymunCode', $student->municipality_code)->get();

    // Fetch campuses based on user role
    $userRole = Auth::user()->role;
    $campuses = ($userRole === 0 || $userRole === 1) ? Campus::all() : Campus::where('id', 1)->get();

    // Fetch courses based on the selected campus
    $courses = $student->campus_id ? Campus::findOrFail($student->campus_id)->courses : [];

    return view('editStudent', compact('student', 'provinces', 'municipalities', 'barangays', 'courses', 'campuses'));
}

    

     public function update ($rowId) {
        $student = Student::findOrFail($rowId);

        $student->update(request()->all());
    
        return redirect()->back()->with('success', 'Student updated successfully.');


     }

     public function getMunicipalities(Request $request)
     {
         $provinceId = $request->input('province');
         $municipalities = Municipal::where('provCode', $provinceId)->get();
         return response()->json($municipalities);
     }
 
     public function getBarangays(Request $request)
     {
         $municipalityId = $request->input('municipality');
         $barangays = Barangay::where('citymunCode', $municipalityId)->get();
         return response()->json($barangays);
     }

}