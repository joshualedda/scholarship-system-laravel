<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Grantee;
use App\Models\Student;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\ScholarshipName;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public $fundSources, $selectedSources;
    public $years, $selectedYear;

    public function index()
    {
        $fundSources = ScholarshipName::all();
        $years = SchoolYear::orderBy('school_year', 'desc')->distinct()->limit(8)->get();

        return view('dashboard', compact('fundSources', 'years'));
    }



    public function getStudents(Request $request)
    {
        $selectedScholarshipType = $request->input('selectedScholarshipType', null);
        $selectedYear = $request->input('selectedYear', null);
    
        // Retrieve students count with grouping by scholarship name and filtering by campus
        $studentsCount = Grantee::join('scholarship_name', 'grantees.scholarship_name', '=', 'scholarship_name.id')
            ->join('students', 'grantees.student_id', '=', 'students.id') // Join students table
            ->where('grantees.scholarship_type', $selectedScholarshipType)
            ->where('grantees.school_year', $selectedYear)
            ->where('students.campus', 2) // Filter by campus in students table
            ->groupBy('scholarship_name.codeName')
            ->select('scholarship_name.codeName as label', DB::raw('COUNT(*) as data'))
            ->get();
    
        // Prepare chart data for response
        $chartData = $studentsCount->toArray();
    
        return response()->json($chartData);
    }
    


    public function filterData(Request $request)
    {
        $selectedSources = $request->input('selectedSources');
        $selectedYear = $request->input('selectedYear');

        $query = Grantee::query();

        // Apply filters if provided
        if ($selectedSources && $selectedSources !== 'all') { // Check if selectedSources is not 'all'
            $query->where('scholarship_name', $selectedSources);
        }

        // If a year is selected, filter by the school year
        if ($selectedYear && $selectedYear !== 'all') { // Check if selectedYear is not 'all'
            // Adjust date filtering for the school year format "YYYY-YYYY"
            $schoolYear = explode('-', $selectedYear);
            $startYear = $schoolYear[0];
            $endYear = $schoolYear[1];

            // Apply filter based on the school year range
            $query->where('school_year', 'LIKE', "{$startYear}-%");
        }

        // Get all possible campus names
        $allCampuses = DB::table('campuses')->pluck('campus_name');

        // Ensure all possible campus names are included in the query result
$query->select('campuses.campus_name', DB::raw('COUNT(grantees.student_id) as student_count'))
->join('students', 'students.id', '=', 'grantees.student_id')
->join('campuses', 'campuses.id', '=', 'students.campus')
->groupBy('campuses.campus_name');


        $campusData = $query->get();

        // Extract labels and data from $campusData
        $labels = $allCampuses->toArray();
        $data = $campusData->pluck('student_count', 'campus_name')->toArray();

        // Fill missing data points with 0
        $data = array_merge(array_fill_keys($labels, 0), $data);

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
























}













