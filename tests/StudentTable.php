<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};
use App\Models\Campus;

final class StudentTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Student>
     */
    public function datasource(): Builder
    {
        $query = Student::query();

        // Apply conditional filtering based on user role
        if (in_array(auth()->user()->role, [0, 1])) {
            // No filtering for staff (role 0) and admin (role 1)
        } else {
            // Filter for role 2 (limited access)
            $query->where('campus', 1);
        }
        return $query
        ->join('barangays', 'students.barangay', '=', 'barangays.brgyCode')
        ->join('municipals', 'students.municipal', '=', 'municipals.citymunCode')
        ->join('provinces', 'students.province', '=', 'provinces.provCode')
        ->join('campuses', 'students.campus', '=', 'campuses.id')
        ->join('courses', 'students.course', '=', 'courses.course_id')
        ->select(
            'students.*',
            'barangays.brgyDesc',
            'municipals.citymunDesc',
            'provinces.provDesc',
            'campuses.campusDesc',
            'courses.course_name',
        );
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
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
            ->addColumn('father')
            ->addColumn('mother')
            ->addColumn('contact')
            ->addColumn('studentType')
            ->addColumn('nameSchool', fn(Student $model) => $model->nameSchool ?? "No Data")
            ->addColumn('lastYear', fn(Student $model) => $model->lastYear ?? "No Data")
            ->addColumn('student_status', fn(Student $model) => $model->getStatusTextAttribute() ?? "No Data");
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
      * PowerGrid Columns.
      *
      * @return array<int, Column>
      */
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

          ];
      }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
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

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Student Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('student.edit', function(\App\Models\Student $model) {
                    return $model->id;
               }),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('student.destroy', function(\App\Models\Student $model) {
                    return $model->id;
               })
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Student Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($student) => $student->id === 1)
                ->hide(),
        ];
    }
    */
}
