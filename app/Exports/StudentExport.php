<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection, ShouldAutoSize
{
    protected $students;




    public function __construct($students)
    {
        $this->students = $students;
    }

    public function collection()
    {
        return collect($this->students);
    }

    // public function headings(): array
    // {
    //     // Define your header based on selected criteria
    //     $headers = [
    //         'Full Name',
    //         'Province', // Add other header fields based on your conditions
    //         'Municipality',
    //         'Campus',
    //         'Course',
    //         'Semester',
    //         'School Year',
    //         'Scholarship Name',
    //         'Scholarship Type',
    //     ];

    //     return $headers;
    // }
   
}
