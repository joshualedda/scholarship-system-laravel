<?php

use App\Http\Controllers\UsersTypeController;
use Livewire\Livewire;
use App\Livewire\AddUser;
use App\Livewire\Reports;
use App\Livewire\AuditTrail;
use App\Livewire\DataBackup;
use App\Livewire\StudentAdd;
use App\Livewire\UpdateUser;
use App\Livewire\EditGrantee;
use App\Livewire\ScholarEdit;
use App\Livewire\ScholarView;
use App\Livewire\SchoolYears;
use App\Livewire\StudentEdit;
use App\Livewire\StudentInfo;
use App\Livewire\UserAccount;
use App\Livewire\ViewGrantee;
use App\Livewire\CampusCourse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EditStudentController;
use App\Http\Controllers\UserTypeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


    // log in
    Route::get('/', function () {
        return view('auth.login');
    });

    Route::get('/login', [ LoginController::class, 'login'])->name('auth.login');
    Route::post('/login', [ LoginController::class, 'loginAction'])->name('login.action');
    Route::post('/logout', [ LoginController::class, 'logout'])->name('logout');

    Route::middleware('web')->group(function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/grantees', [DashboardController::class, 'getStudents']);
    // barChart
    Route::get('/filter-data', [DashboardController::class, 'filterData']);
});



// Student
Route::get('/student', StudentAdd::class)->name('student-add');

// Add student
Route::get('/studentInfo', StudentInfo::class)->name('student-info');

// view
Route::get('/studentGrantee/{rowId}', StudentEdit::class)->name('student-edit');

// scholarship
// viewGrantee
Route::get('/viewGrantee', ViewGrantee::class)->name('view-grantee');
Route::get('/viewGrantee/government', ViewGrantee::class)->name('viewGrantee.government');
Route::get('/viewGrantee/private', ViewGrantee::class)->name('viewGrantee.private');
// edit


// viewGrantee
Route::get('/editGrantee/{editId}', EditGrantee::class)->name('edit-grantee');


// Settings
//accountSet
Route::get('/userAccount', UserAccount::class)->name('user-account');
// update the account
Route::get('/updateAccount/{userId}', UpdateUser::class)->name('update-user');

//Add scholarship
// view
Route::get('/scholarView', ScholarView::class)->name('scholar-view');
// Edit
Route::get('/scholarEdit/{scholar}', ScholarEdit::class)->name('scholar-edit');

// adding User

Route::get('/registerUser', AddUser::class)->name('add-user');


// adding usertype
Route::get('/userTypes/create', [UserTypeController::class, 'create'])->name('userTypes.create');
Route::post('/userTypes', [UserTypeController::class, 'store'])->name('userTypes.store');

// audit Trail
Route::get('/auditTrail', AuditTrail::class)->name('audit-trail');

// backup
Route::get('/backUp', DataBackup::class)->name('data-backup');

// campus && course
Route::get('/programCampus', CampusCourse::class)->name('campus-course');

// schooleYear
Route::get('/schoolYear', SchoolYears::class)->name('school-year');

// reports

Route::get('/studentReports', Reports::class)->name('reports');
// Route::get('/chart-data', [DashboardController::class, 'getChartData']);


//
Route::get('student/edit/{rowId}', [EditStudentController::class, 'edit'])->name('student-update');
// edit student
Route::put('student/update/{rowId}', [EditStudentController::class, 'update'])->name('student.update');



// address filtering
Route::get('/get-municipalities', [EditStudentController::class, 'getMunicipalities'])->name('get.municipalities');
Route::get('/get-barangays', [EditStudentController::class, 'getBarangays'])->name('get.barangays');



// Add User Type -- New Feature
Route::get('admin/usertype', [UsersTypeController::class, 'index'])->name('usertype.list');
//add user type
Route::get('admin/usertype/create', [UsersTypeController::class, 'create'])->name('usertype.create');
// store
Route::post('admin/usertype/store', [UsersTypeController::class, 'store'])->name('usertype.store');
//view
Route::get('admin/usertype/show/{id}', [UsersTypeController::class, 'show'])->name('usertype.show');
Route::get('admin/usertype/edit/{id}', [UsersTypeController::class, 'edit'])->name('usertype.edit');
//Uupdate
Route::put('admin/usertype/update/{userType}', [UsersTypeController::class, 'update'])->name('usertype.update');
