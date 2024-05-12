<div>
    <section class="mt-2 p-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="text-align: center; font-size:25px; font-weight: bold;">
                        Student Data
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="student_id">Student ID</label>
                                    <div class="input-group">
                                        <input type="text" id="student_id" class="form-control form-control-sm"
                                            name="student_id" maxlength="10" aria-describedby="studentIdHelp"
                                            wire:model.live="student_id">

                                        <button type="button" class="btn btn-primary" wire:click="studentSearch"
                                            wire:loading.attr="disabled">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                    <small id="studentIdHelp" class="form-text text-muted">Enter the 8-digit student
                                        ID.</small>
                                    @error('student_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if ($noStudentRecord)
                            <div class="col-md-3 mt-3">
                                <div class="alert alert-danger" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    No record of the student.
                                </div>
                            </div>
                            @endif

                            <script>
                                document.addEventListener("DOMContentLoaded", function()
                                        {
                                            const studentIdInput = document.getElementById("student_id");
                                            studentIdInput.addEventListener("input", function() {
                                            let inputText = this.value.replace(/\D/g, "").substring(0, 10);
                                            let formattedText = inputText.replace(/(\d{3})(\d{4})(\d{1,2})/, "$1-$2-$3");
                                            this.value = formattedText;
                                            });
                                        });
                            </script>

                            {{-- id end --}}
                        </div>

                        <div class="row">
                            <div class="col-3 col-md-8">
                                <label class="form-label" for="campus">CAMPUS</label>
                                <input class="form-control form-control-sm" type="text" wire:model.live="selectedCampus"
                                    @if($selectedCampus) disabled @endif>

                            </div>
                            <div class="col-3 col-md-4">
                                <label class="form-label" for="studentType">STUDENT TYPE</label>
                                <input class="form-control form-control-sm" type="text" wire:model.live="studentType"
                                    @if($studentType) disabled @endif name="studentType">
                            </div>
                            <div class="col-3 col-md-6">
                                <label for="nameSchool"><span class="text-danger">*</span> If new, indicate name of
                                    school last attended:</label>
                                <input type="text" class="form-control form-control-sm" name="nameSchool"
                                    id="nameSchool" wire:model.defer="nameSchool" @if($nameSchool) disabled @endif>
                            </div>
                            <div class="col-3 col-md-6">
                                <label for="lastYear"><span class="text-danger">*</span> School year last
                                    attended:</label>
                                <input type="text" class="form-control form-control-sm" name="lastYear" id="lastYear"
                                    wire:model.defer="lastYear" @if($lastYear) disabled @endif>
                            </div>
                        </div>



                        <div class="row">
                            <p class="fw-bold fs-5">I. STUDENT INFORMATION</p>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label" for="lastname" name="lastname">Last name</label>
                                <input type="text" id="lastname" wire:model.live="lastname" @if($lastname) disabled
                                    @endif class="form-control form-control-sm " />
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label" for="firstname" name="firstname">First name</label>
                                <input type="text" id="firstname" class="form-control form-control-sm"
                                    wire:model.live="firstname" @if($firstname) disabled @endif />
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label" for="initial" name="initial">Middle Initial</label>
                                <input type="text" id="initial" class="form-control form-control-sm"
                                    wire:model.live="initial" @if($initial) disabled @endif />
                            </div>
                        </div>

                        <div class="row">
                            <p class="mt-3 fw-bold fs-6">ADDRESS<span class="text-danger">*</span></p>

                            <!-- Province Address -->
                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label">Province</label>
                                <input type="text" class="form-control form-control-sm"
                                    wire:model.live="selectedProvince" @if($selectedProvince) disabled @endif />
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label">City/Municipality</label>
                                <input type="text" class="form-control form-control-sm"
                                    wire:model.live="selectedMunicipality" @if($selectedMunicipality) disabled @endif />
                            </div>

                            <div class="col-md-4 position-relative mt-0">
                                <label class="form-label">Barangay</label>
                                <input type="text" class="form-control form-control-sm"
                                    wire:model.live="selectedBarangay" @if($selectedBarangay) disabled @endif />
                            </div>
                        </div>

                        <div class="row mx-3">
                            <div class="col-md-3 position-relative mt-3">
                                <label class="form-label" for="sex">Sex</label>
                                <input type="text" id="sex" class="form-control form-control-sm" wire:model.live="sex"
                                    @if($sex) disabled @endif />
                            </div>
                            <div class="col-md-3 position-relative mt-3">
                                <label class="form-label">Civil Status</label>
                                <input type="text" id="status" class="form-control form-control-sm"
                                    wire:model.live="status" @if($status) disabled @endif />
                            </div>
                            <div class="col-md-3 position-relative mt-3">
                                <label class="form-label" for="contact">Contact
                                    Number</label>
                                <input type="text" id="contact" class="form-control form-control-sm"
                                    wire:model.live="contact" maxlength="11" minlength="11" @if($contact) disabled
                                    @endif />
                            </div>
                            <!-- Email -->
                            <div class="col-md-3 position-relative mt-3">
                                <label class="form-label" for="email">Email Address</label>
                                <input type="email" id="email" class="form-control form-control-sm"
                                    wire:model.live="email" name="email" @if($email) disabled @endif />
                            </div>
                        </div>

                        <div class="row mt-3 mb-3">
                            <!-- Level -->
                            <div class="col-md-3 position-relative mt-0">
                                <label class="form-label">Year level</label>
                                <input type="text" name="level" id="level" class="form-control form-control-sm"
                                    wire:model.live="level" @if($level) disabled @endif>
                            </div>

                            <!-- Course -->
                            <div class="col-md-6 position-relative mt-0">
                                <label class="form-label">Course</label>
                                <input class="form-control form-control-sm" wire:model.live="selectedCourse"
                                    @if($selectedCourse) disabled @endif />
                            </div>
                        </div>

                        {{-- family --}}
                        <div class="row mb-4">
                            <p class="fw-bold fs-5">II. FAMILY INFORMATION</p>

                            <div class="col-md-6 position-relative mt-0">
                                <label class="form-label" for="father" name="father">Father's Full
                                    name</label>
                                <input type="text" id="father" class="form-control form-control-sm" name="father"
                                    wire:model.live="father" @if($father) disabled @endif />
                            </div>

                            <div class="col-md-6 position-relative mt-0">
                                <label class="form-label" for="mother" name="mother">Mother's Full
                                    name</label>
                                <input type="text" id="mother" class="form-control form-control-sm" name="mother"
                                    wire:model="mother" @if($mother) disabled @endif />
                            </div>
                        </div>



                        <div class="row">
                            <form wire:submit.prevent="addScholarship">
                                @csrf
                                <h4 class="fw-bold fs-5">III. Scholarships</h4>
                                <div class="row">
                                    <!-- First Group -->
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label mb-1" for="semester">Semester</label>
                                                <select wire:model.live="semester" class="form-select form-select-sm mb-2">
                                                    <option selected>Select semester</option>
                                                    <option value="1">1st</option>
                                                    <option value="2">2nd</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label mb-1" for="selectedYear">School Year</label>
                                                <select wire:model.live="school_year" class="form-select form-select-sm">
                                                    <option selected>Select school year</option>
                                                    @foreach ( $years as $year )
                                                        <option value="{{ $year->school_year }}">{{ $year->school_year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label mb-1" for="selectedScholarshipType1">Scholarship Type</label>
                                                <select wire:model.live="selectedScholarshipType1" class="form-select form-select-sm mb-2">
                                                    <option selected>Select Scholarship Type</option>
                                                    <option value="0">Government</option>
                                                    <option value="1">Private</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label mb-1" for="selectedfundsources1">Fund Sources</label>
                                                <select class="form-select form-select-sm" wire:model.live="selectedfundsources1">
                                                    <option selected>Select Fund Source</option>
                                                    @foreach($fundSources1 as $source)
                                                        <option value="{{ $source->id }}">{{ $source->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Second Group -->
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label mb-1" for="semester2">Semester</label>
                                                <select wire:model.live="semester2" class="form-select form-select-sm mb-2">
                                                    <option selected>Select semester</option>
                                                    <option value="1">1st</option>
                                                    <option value="2">2nd</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label mb-1" for="selectedYear2">School Year</label>
                                                <select wire:model.live="school_year2" class="form-select form-select-sm">
                                                    <option selected>Select school year</option>
                                                    @foreach ( $years as $year )
                                                        <option value="{{ $year->school_year }}">{{ $year->school_year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label mb-1" for="selectedScholarshipType2">Scholarship Type</label>
                                                <select wire:model.live="selectedScholarshipType2" class="form-select form-select-sm mb-2">
                                                    <option selected>Select Scholarship Type</option>
                                                    <option value="0">Government</option>
                                                    <option value="1">Private</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label mb-1" for="selectedfundsources2">Fund Sources</label>
                                                <select class="form-select form-select-sm" wire:model.live="selectedfundsources2">
                                                    <option selected>Select Fund Source</option>
                                                    @foreach($fundSources2 as $source)
                                                        <option value="{{ $source->id }}">{{ $source->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Button Section -->
                                <div class="row mt-5">
                                    <div class="col-md-6 d-flex justify-content-start gap-4">
                                        <button type="submit" wire:loading.attr='disabled' class="btn btn-success btn-md fw-bold text-dark mt-2">
                                            <i class="mdi mdi-content-save"></i> Save
                                        </button>
                                        <a type="button" class="btn btn-danger btn-md fw-bold text-dark mt-2" href="{{ url('student') }}">
                                            <i class="mdi mdi-close-circle"></i> Cancel
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Display success message -->
                                        @if (session()->has('success'))
                                            <div class="alert alert-success text-center">{{ session('success') }}</div>
                                        @endif
                                        @if (session()->has('error'))
                                            <div class="alert alert-danger text-center">{{ session('error') }}</div>
                                        @endif
                                        <!-- ends here -->
                                    </div>
                                </div>
                            </form>
                        </div>


                        {{-- else --}}



                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
