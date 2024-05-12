<div>
    <section class="p-2">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    @if (session()->has('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="card-header">
                        <h2>Students Reports</h2>
                    </div>
                    <div class="card-body shadow-lg">
                        <div class="container">
                            <form >
                                @csrf
                                <div class="col-md-12 mb-2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label">Province</label>
                                            <select class="form-select form-select-sm" id="selectedProvince"
                                                name="selectedProvince" wire:model.live="selectedProvince">
                                                <option selected>Select Province</option>
                                                @foreach ($provinces as $province)
                                                <option value="{{ $province->provCode }}">{{ $province->provDesc }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">City / Municipality</label>
                                            <select class="form-select form-select-sm" id="selectedMunicipality"
                                                name="selectedMunicipality" wire:model.live="selectedMunicipality">
                                                <option selected>Select City / Municipality</option>
                                                @foreach ($municipalities as $municipality)
                                                <option value="{{ $municipality->citymunCode }}">{{
                                                    $municipality->citymunDesc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Barangay</label>
                                            <select class="form-select form-select-sm" name="selectedBarangay"
                                                id="selectedBarangay" wire:model.live='selectedBarangay'>
                                                <option selected>Select Barangay</option>
                                                @foreach ($barangays as $barangay)
                                                <option value="{{ $barangay->brgyCode }}">{{ $barangay->brgyDesc }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Campus</label>
                                            <select class="form-select form-select-sm" name="selectedCampus"
                                                id="selectedCampus" wire:model.live="selectedCampus">
                                                <option selected>Select Campus below...</option>
                                                @foreach ($campuses as $campus )
                                                <option value="{{ $campus->id }}">{{ $campus->campusDesc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Course</label>
                                            <select class="form-select form-select-sm" name="selectedCourse"
                                                id="selectedCourse" wire:model.live="selectedCourse">
                                                <option selected>Select Course below</option>
                                                @foreach ($courses as $course )
                                                <option value="{{ $course->course_id }}">{{ $course->course_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <label class="form-label">Semester</label>
                                            <select class="form-select form-select-sm" name="semester" id="semester"
                                                name="semester" wire:model.live="semester" >
                                                <option selected>Select Semester</option>
                                                <option value="1">1st</option>
                                                <option value="2">2nd</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">School year</label>
                                            <select class="form-select form-select-sm" id="selectedYear"
                                                name="selectedYear" wire:model.live="selectedYear">
                                                <option selected>School year</option>
                                                @foreach($years as $year)
                                                <option value="{{ $year->school_year }}">{{ $year->school_year }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('selectedYear')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Scholarship Type</label>
                                            <select class="form-select form-select-sm"
                                                wire:model.live="selectedScholarshipType">
                                                <option selected>School scholarship type</option>
                                                <option value="0">Government</option>
                                                <option value="1">Private</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Funds Source</label>
                                            <select class="form-select form-select-sm"
                                                wire:model.live="selectedfunsources">
                                                <option selected>Select a fund source</option>
                                                @foreach ($fundsources as $source )
                                                <option value="{{ $source->id }}">{{ $source->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-start mt-4">
                                    <button type="submit" class="btn btn-md btn-primary" wire:click="export"
                                        wire:loading.attr="disabled">
                                        Generate Report
                                    </button>
                                    <span wire:loading class="text-dark fw-bold">Loading...</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
