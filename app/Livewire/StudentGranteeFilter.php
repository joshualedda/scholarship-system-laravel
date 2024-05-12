<?php

namespace App\Livewire;

use App\Models\Grantee;
use App\Models\Student;
use App\Models\SchoolYear;
use Illuminate\Support\Carbon;
use App\Models\ScholarshipName;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class studentGranteeFilter extends PowerGridComponent
{
    use WithExport;
    public $scholarship_type_filter;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): ?Builder
    {
        $query = Student::query();


            if (in_array(Auth::user()->role, [0, 1])) {
                // No filtering for staff (role 0) and admin (role 1)
            } else {
                // Filter for role 2 (limited access)
                $query->where('campus', 1);
            }

            return $query
                ->join('grantees', function ($grantees) {
                    $grantees->on('students.id', '=', 'grantees.student_id');
                })
                ->join('scholarship_name', function ($scholarship_name) {
                    $scholarship_name->on('grantees.scholarship_name', '=', 'scholarship_name.id');
                })
                ->join('barangays', function ($barangays) {
                    $barangays->on('students.barangay', '=', 'barangays.brgyCode');
                })
                ->join('municipals', function ($municipals) {
                    $municipals->on('students.municipal', '=', 'municipals.citymunCode');
                })
                ->join('provinces', function ($provinces) {
                    $provinces->on('students.province', '=', 'provinces.provCode');
                })
                ->join('campuses', function ($campuses) {
                    $campuses->on('students.campus', '=', 'campuses.id');
                })
                ->join('courses', function ($courses) {
                    $courses->on('students.course', '=', 'courses.course_id');
                })
                ->select(
                    'students.*',
                    'barangays.brgyDesc',
                    'municipals.citymunDesc',
                    'provinces.provDesc',
                    'campuses.campusDesc',
                    'courses.course_name',
                    'grantees.semester',
                    'grantees.school_year',
                    'scholarship_name.name',
                    'grantees.scholarship_type'
                )->where('grantees.scholarship_type', '=', 0);

        }


    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('student_id')

           /** Example of custom column using a closure **/
            ->addColumn('student_id_lower', fn (Student $model) => strtolower(e($model->student_id)))

            ->addColumn('lastname')
            ->addColumn('firstname')
            ->addColumn('full_name', function (Student $model) {
                return $model->firstname . ' ' . $model->lastname;
            })
            ->addColumn('initial')
            ->addColumn('email')
            ->addColumn('sex')
            ->addColumn('status')
            ->addColumn('brgyDesc')
            ->addColumn('citymunDesc')
            ->addColumn('provDesc')
            ->addColumn('campusDesc')
            ->addColumn('course_name')
            ->addColumn('level')
            ->addColumn('semester')
            ->addColumn('shcool_year')
            ->addColumn('father')
            ->addColumn('mother')
            ->addColumn('contact')
            ->addColumn('studentType')
            ->addColumn('nameSchool', fn(Student $model) => $model->nameSchool ?? "No Data")
            ->addColumn('lastYear', fn(Student $model) => $model->lastYear ?? "No Data")
            ->addColumn('name')
            ->addColumn('scholarship_type', fn(Student $model) => $model->getTextAttribute() ?? "No Data")
            ->addColumn('student_status', fn(Student $model) => $model->getStatusTextAttribute() ?? "No Data");
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
            ->hidden()
            ->visibleInExport(true),
            Column::make('Student id', 'student_id')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Lastname', 'lastname')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Firstname', 'firstname')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),
            Column::make('Name', 'full_name')
                ->searchable()
                ->visibleInExport(false),

                Column::make('Middle Initial', 'initial')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Email Address', 'email')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Sex', 'sex')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Barangay', 'brgyDesc')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),
            Column::make('Municipal', 'citymunDesc')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),
            Column::make('Province', 'provDesc')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),
            Column::make('Campus', 'campusDesc')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),
            Column::make('Course/Program', 'course_name')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Year level', 'level'),
            Column::make('Semester', 'semester'),
            Column::make('School Year', 'school_year'),

            Column::make('Father Fullname', 'father')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Mother Fullname', 'mother')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Contact Number', 'contact')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Type of Student', 'studentType')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Name of School Last Attended', 'nameSchool')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Last School Year Attended', 'lastYear')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Recepient', 'name')
                ->sortable()
                ->searchable()
                ->visibleInExport(true),

                Column::make('Scholarship Type', 'scholarship_type')
                ->sortable()
                ->searchable()
                ->visibleInExport(true),

            Column::make('Remarks', 'student_status')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),


            Column::action('Action')
                ->visibleInExport(false),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('level', 'level')
            ->dataSource(Student::select('level')->distinct()->orderBy('level')->get())
            ->optionValue('level')
            ->optionLabel('level'),

            Filter::select('semester', 'semester')
            ->dataSource([
                ['semester' => 1, 'name' => '1st'],
                ['semester' => 2, 'name' => '2nd'],
            ])
            ->optionValue('semester')
            ->optionLabel('name'),

            Filter::select('school_year', 'school_year')
            ->dataSource(SchoolYear::select('school_year')->distinct()->orderBy('school_year')->get())
            ->optionValue('school_year')
            ->optionLabel('school_year'),

            Filter::select('name', 'name')
            ->dataSource(ScholarshipName::select('name')->orderBy('name')->get())
            ->optionValue('name')
            ->optionLabel('name'),

            // Filter::select('scholarship_type', 'scholarship_type')
            // ->dataSource([
            //     ['scholarship_type' => 0, 'name' => 'Government'],
            //     ['scholarship_type' => 1, 'name' => 'Private'],
            // ])
            // ->optionValue('scholarship_type')
            // ->optionLabel('name'),
        ];
    }



    public function actions(Student $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->class('btn btn-primary btn-sm fw-bold dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->route('edit-grantee', ['editId' => $row->id])
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
