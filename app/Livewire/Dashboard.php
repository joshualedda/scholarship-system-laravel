<?php

namespace App\Livewire;

use App\Models\Campus;
use App\Models\Grantee;
use App\Models\Student;
use Livewire\Component;
use App\Models\SchoolYear;
use App\Models\StudentGrantee;
use App\Models\ScholarshipName;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class Dashboard extends Component
{
    // public $governmentStudent, $privateStudent;

    public $government, $private;
    public $governmentActive, $privateActive;
    public $governmentStudent, $privateStudent;



    public function mount()
    {

        // 1st card
        $this->government = ScholarshipName::where('scholarship_type', 0)->count();
        $this->private = ScholarshipName::where('scholarship_type', 1)->count();

        // scholarship active and inactiive
        $this->governmentActive = ScholarshipName::where('status', 0)->where('scholarship_type', 0)->count();
        $this->privateActive = ScholarshipName::where('status', 0)->where('scholarship_type', 1)->count();

        // 2nd card
        // Count scholars in government
    if(Auth::user()->role === 1 || Auth::user()->role === 0)
    {
        $this->governmentStudent = DB::table('grantees')
        ->where('scholarship_type', 0)
        ->count('student_id');


        // Count scholars in private
        $this->privateStudent = DB::table('grantees')
        ->where('scholarship_type', 1)
        ->count('student_id');
    } else{
    // Count scholars in government with campus 1
        $this->governmentStudent = Grantee::where('scholarship_type', 0)
        ->whereHas('student', function ($query) {
            $query->where('campus', 1);
        })
        ->count();

         $this->privateStudent= Grantee::where('scholarship_type', 1)
        ->whereHas('student', function ($query) {
            $query->where('campus', 1);
        })
        ->count();


    }

    }



    public function render()
    {
        return view('livewire.dashboard');
    }




}
