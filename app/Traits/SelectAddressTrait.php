<?php
namespace App\Traits;

use App\Models\Municipal;
use App\Models\Barangay;


trait SelectAddressTrait
{
    public $selectedProvince;
    public $selectedMunicipality;
    public $selectedBarangay;
    public $municipalities = [];
    public $barangays = [];

    public function updatedSelectedCity($provinceId)
    {
        $this->municipalities = Municipal::where('provCode', $provinceId)->get();
        $this->selectedMunicipality = null;
        $this->selectedBarangay = null;
        $this->barangays = [];
    }
    public function updatedSelectedMunicipality($municipalityId)
    {
        $this->barangays = Barangay::where('citynumCode', $municipalityId)->get();
        $this->selectedBarangay = null;
    }

}
