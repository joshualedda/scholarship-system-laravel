<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow
{
    private $errors = [];

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        dd($row);
        // // Skip the first column (index 0) using array_slice
        $data = [
            'student_id' => $row[0],
            'firstname' => $row[1],
            'lastname' => $row[2],
            'initial' => $row[3] ?? null, // Handle optional field
            'email' => $row[4],
            'sex' => $row[5],
            'status' => $row[6] ?? null, // Handle optional field
            'barangay' => $row[7],
            'municipal' => $row[8],
            'province' => $row[9],
            'campus' => $row[10],
            'course' => $row[11],
            'level' => $row[12],
            'father' => $row[13],
            'mother' => $row[14],
            'contact' => $row[15],
            'studentType' => $row[16],
            'nameSchool' => $row[17] ?? null, // Handle optional field
            'lastYear' => $row[18] ?? null, // Handle optional field
        ];
        return new Student($data);
    }

        // $rules = [
        //     'student_id' => 'required|unique:students,student_id',
        //     'firstname' => 'required|string|max:255',
        //     'lastname' => 'required|string|max:255',
        //     'email' => 'required|email|unique:students,email',
        //     'sex' => 'required|in:Male,Female', // Ensure valid sex values
        //     'status' => 'required|string|max:255',
        //     'barangay' => 'required|integer',
        //     'municipal' => 'required|integer',
        //     'province' => 'required|integer',
        //     'campus' => 'required|integer',
        //     'course' => 'required|integer',
        //     'level' => 'required|integer',
        //     'father' => 'required|string|max:255',
        //     'mother' => 'required|string|max:255',
        //     'contact' => 'required|string|max:255',
        //     'studentType' => 'required|string|max:255',
        //     'nameSchool' => 'nullable|string|max:255', // Optional field
        //     'lastYear' => 'nullable|string|max:255', // Optional field
        // ];

        // dd($row);
       
        // $validator = Validator::make($row, $rules);

        // if ($validator->fails()) {
        //     $this->errors[] = $validator->errors()->first();
        //     return null; // Skip creating the model
        // }


    //     return new Student([
    //         'student_id' => $row['student_id'],
    //         'firstname' => $row['firstname'],
    //         'lastname' => $row['lastname'],
    //         'initial' => $row['initial'] ?? null, // Handle optional field
    //         'email' => $row['email'],
    //         'sex' => $row['sex'],
    //         'status' => $row['status'] ?? null, // Handle optional field
    //         'barangay' => $row['barangay'],
    //         'municipal' => $row['municipal'],
    //         'province' => $row['province'],
    //         'campus' => $row['campus'],
    //         'course' => $row['course'],
    //         'level' => $row['level'],
    //         'father' => $row['father'],
    //         'mother' => $row['mother'],
    //         'contact' => $row['contact'],
    //         'studentType' => $row['studentType'],
    //         'nameSchool' => $row['nameSchool'] ?? null, // Handle optional field
    //         'lastYear' => $row['lastYear'] ?? null, // Handle optional field
    //     ]);
    // }

    public function getErrors(): array
    {
        return $this->errors;
    }

}
