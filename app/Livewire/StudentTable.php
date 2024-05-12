<?php

namespace App\Livewire;

use App\Models\Campus;
use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class StudentTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            // Responsive::make(),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(mode:'min'),
        ];
    }

    public function datasource(): ?Builder
    {
        $query = Student::query();

        // Apply conditional filtering based on user role
        if (in_array(Auth::user()->role, [0, 1])) {
            // No filtering for staff (role 0) and admin (role 1)
        } else {
            // Filter for role 2 (limited access)
            $query->where('campus', 1);
        }

        return $query
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
                'campuses.campus_name',
                'courses.course_name'
            );
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

            // ->addColumn('lastname')
            // ->addColumn('firstname')
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
            ->addColumn('campus_name')
            ->addColumn('course_name')
            ->addColumn('level')
            ->addColumn('father')
            ->addColumn('mother')
            ->addColumn('contact')
            ->addColumn('studentType')
            ->addColumn('nameSchool', fn(Student $model) => $model->nameSchool ?? "No Data")
            ->addColumn('lastYear', fn(Student $model) => $model->lastYear ?? "No Data")
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


            Column::make('Name', 'full_name')->searchable(),

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
            Column::make('Campus', 'campus_name')
                ->sortable()
                ->searchable(),
            Column::make('Course/Program', 'course_name')
                ->sortable()
                ->searchable()
                ->hidden()
                ->visibleInExport(true),

            Column::make('Year level', 'level'),

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

            Column::make('Remarks', 'student_status')
                ->sortable()
                ->searchable(),

            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('level', 'level')
            ->dataSource(Student::select('level')->distinct()->orderBy('level')->get())
            ->optionValue('level')
            ->optionLabel('level'),

            Filter::select('student_status', 'student_status')
            ->dataSource([
                ['student_status' => 0, 'name' => 'Active'],
                ['student_status' => 1, 'name' => 'Inactive'],
            ])
            ->optionValue('student_status')
            ->optionLabel('name'),

            Filter::select('campusDesc', 'campusDesc')
            ->dataSource(Campus::select('campusDesc')->distinct()->orderBy('campusDesc')->get())  // Adjust query if needed
            ->optionValue('campusDesc')
            ->optionLabel('campusDesc'),
        ];
    }

    // #[\Livewire\Attributes\On('view')]
    // public function view($rowId): void
    // {
    //     $this->js('alert('.$rowId.')');
    // }

    public function actions(Student $row): array
    {
        return [
            Button::add('view')
                ->slot('<span style="color: black;">Scholarship</span>')
                ->class('btn btn-primary btn-sm m-1')
                ->route('student-edit', ['rowId' => $row->id]),
        
            // edit
            Button::add('edit')
                ->slot('<span style="color: black;">Edit</span>')
                ->class('btn btn-warning btn-sm m-1')
                ->route('student-update', ['rowId' => $row->id])
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
