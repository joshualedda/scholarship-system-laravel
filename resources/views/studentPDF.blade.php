@include('layouts.header')
<section class="p-2">
    <div class="page-break">
    <h1>Grantees List</h1>
    <table>
        <thead>
            <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Sex</th>
                    <th>Civil Status</th>
                    <th>Barangay</th>
                    <th>Municipal</th>
                    <th>Province</th>
                    <th>Campus</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Father's Full Name</th>
                    <th>Mother's Full Name</th>
                    <th>Contact Number</th>
                    <th>Type of Student</th>
                    <th>Name of School Last Attended</th>
                    <th>School Year Last Attended</th>
                    <th>Semester</th>
                    <th>School Year</th>
                    <th>Scholarship</th>
                    <th>Scholarship Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $student)
            <tr>
                <td>{{ $student->lastname }}, {{ $student->firstname }} {{ $student->initial }}</td>
                {{-- <td>{{ $student->email }}</td>
                <td>{{ $student->sex }}</td>
                <td>{{ $student->status }}</td> --}}
                <td>{{ $student->brgyDesc }}</td>
                <td>{{ $student->citymunDesc }}</td>
                <td>{{ $student->provDesc }}</td>
                <td>{{ $student->campus_name }}</td>
                <td>{{ $student->course_name }}</td>
                <td>{{ $student->level }}</td>
                {{-- <td>{{ $student->father }}</td>
                <td>{{ $student->mother }}</td> --}}
                <td>{{ $student->contact }}</td>
                <td>{{ $student->studentType }}</td>
                <td>{{ $student->nameSchool ?? "No Data" }}</td>
                <td>{{ $student->lastYear ?? "No Data" }}</td>
                <td>{{ $student->semester }}</td>
                <td>{{ $student->school_year }}</td>
                <td>{{ $student->scholarship_name }}</td>
                <td>{{ $student->scholarship_type === 0 ? 'Government' : 'Private' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <style>
        .page-break {
            page-break-after: always;
        }
        </style>
</section>

@include('layouts.footer')
