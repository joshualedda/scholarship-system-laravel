<div>
    <section class="mt-2 p-1">
        <div class="row">

<div class="d-flex justify-content-end my-2">
    <a type="button" class="btn btn-danger btn-md fw-bold mt-2"
    href="{{ url('student') }}">
    <i class="mdi mdi-close-circle"></i>
    Back
</a>


</div>



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
                                                name="student_id" maxlength="10"
                                                wire:model.live="student_id" disabled>

                                            {{-- <button type="button" class="btn btn-primary" wire:click="studentSearch"
                                                wire:loading.attr="disabled">
                                                <i class="fas fa-search"></i>
                                            </button>
                                            <span wire:loading>Filtering...</span> --}}
                                        </div>
                                        {{-- <small id="studentIdHelp" class="form-text text-muted">Enter the 8-digit student
                                            ID.</small> --}}
                                        @error('student_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- id end --}}
                            </div>
                            <div class="form-group mt-1">
                                <label for="campus-selection" class="fw-bold fs-5 mb-2">CAMPUS:</label>
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-2">
                                    <div class="col">
                                        @foreach ($campuses as $campus)
                                        <label class="form-check-label" for="selectedCampus">
                                            <input class="form-check-input campus-radio" type="radio"
                                                wire:model.live="selectedCampus" value="{{ $campus->id }}"
                                                id="selectedCampus" name="selectedCampus" disabled>
                                            {{ $campus->campus_name }}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                            <hr>

                            <div class="row mt-2 mb-2 row-cols-1 row-cols-sm-2 row-cols-md-2 g-2">
                                <div class="col">
                                    @foreach (['New', 'Continuing', 'Returning Student'] as $type)
                                    <label class="form-check-label">
                                        <input class="form-check-input @error('studentType') is-invalid @enderror"
                                            type="radio" name="studentType" id="check{{ $type }}" value="{{ $type }}"
                                            wire:model.live="studentType"
                                            wire:click="toggleNewInput({{ $type === 'New' ? 'true' : 'false' }})"
                                            style="margin-right: 5px;" disabled> {{ $type }}
                                    </label>
                                    @endforeach
                                </div>
                                @error('studentType')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="col-md-4 mx-3 my-1" id="newInput"
                                style="display: @if ($showNewInput) block @else none @endif;">
                                <label for="nameSchool"><span class="text-danger">*</span> If new, indicate name of
                                    school last attended:</label>
                                <input type="text" class="form-control form-control-sm" name="nameSchool"
                                    id="nameSchool" wire:model.live="nameSchool" disabled>
                                <label for="lastYear"><span class="text-danger">*</span> School year last
                                    attended:</label>
                                <input type="text" class="form-control form-control-sm" name="lastYear" id="lastYear"
                                    wire:model.live="lastYear" disabled>
                            </div>


                            <div class="row">
                                <p class="fw-bold fs-5">I. STUDENT INFORMATION</p>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label" for="lastname">Last name</label>
                                    <input type="text" id="lastname"
                                        class="form-control form-control-sm @error('lastname') is-invalid @enderror"
                                        wire:model.live="lastname" name="lastname"  disabled/>
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label" for="firstname">First name</label>
                                    <input type="text" id="firstname"
                                        class="form-control form-control-sm @error('firstname') is-invalid @enderror"
                                        wire:model.live="firstname" name="firstname" disabled />
                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label" for="initial" name="initial">Middle Initial</label>
                                    <input type="text" id="initial"
                                        class="form-control form-control-sm @error('initial') is-invalid @enderror"
                                        wire:model.live="initial" name="initial" disabled />
                                    @error('initial')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label">Province</label>
                                    <input class="form-select" wire:model="selectedProvince"
                                        name="selectedProvince" disabled >
                                </div>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label">City/Municipality</label>
                                    <input class="form-select" wire:model.live="selectedMunicipality"
                                        name="selectedMunicipality" disabled>
                                </div>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label">Barangay</label>
                                    <input class="form-select" wire:model.live="selectedBarangay"
                                        name="selectedBarangay" disabled>
                                </div>
                            </div>

                            {{-- sex here --}}
                            <div class="row g-3">
                                <div class="col-md-3 position-relative mt-3">
                                        <label class="form-label" for="sex">Sex</label>
                                        <input type="text" class="form-control form-control-sm" wire:model.live="sex" disabled>
                                </div>

                                <div class="col-md-3 position-relative mt-3">
                                        <label class="form-label" for="status">Civil Status</label>
                                        <input class="form-control form-control-sm" type="text" wire:model.live="status" name="status" disabled>
                                </div>

                                <div class="col-md-3 position-relative mt-3">
                                    <label class="form-label" for="contact">Contact
                                        Number</label>
                                    <input type="text" id="contact"
                                        class="form-control form-control-sm @error('contact') is-invalid @enderror"
                                        wire:model.live="contact" maxlength="11" minlength="11" name="contact" disabled />
                                    @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- Email -->
                                <div class="col-md-3 position-relative mt-3">
                                    <label class="form-label" for="email">Email Address</label>
                                    <input type="email" id="email"
                                        class="form-control form-control-sm @error('email') is-invalid @enderror"
                                        wire:model.live="email" name="email" disabled/>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- sex end --}}

                            <div class="row mt-2 mb-2">
                                <div class="col-md-3 position-relative mt-0">
                                    <label class="form-label">Year level</label>
                                    <select name="level" id="level"
                                        class="@error('level') is-invalid @enderror form-select form-select-md text-center"
                                        wire:model.live="level" disabled>
                                        <option selected>Select year level</option>
                                        @foreach (['1','2','3','4','5','6'] as $yearLevel )
                                        <option value="{{ $yearLevel }}">{{ $yearLevel }}</option>
                                        @endforeach
                                    </select>
                                    @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Course -->
                                <div class="col-md-6 position-relative mt-0">
                                    <label class="form-label">Course</label>
                                    <select class="form-select" id="selectedCourse" name="selectedCourse"
                                        wire:model.live="selectedCourse" disabled>
                                        <option selected>Select Course</option>
                                        @foreach ($courses as $course)
                                        <option value="{{ $course->course_id }}">{{ $course->course_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('selectedCourse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- family --}}
                            <div class="row mb-4">
                                <p class="fw-bold fs-5">II. FAMILY INFORMATION</p>

                                <div class="col-md-6 position-relative mt-0">
                                    <label class="form-label" for="father" name="father">Father's Full
                                        name</label>
                                    <input type="text" id="father" disabled
                                        class="form-control form-control-sm @error('father') is-invalid @enderror"
                                        name="father" wire:model.live="father" />
                                    @error('father')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 position-relative mt-0">
                                    <label class="form-label" for="mother" name="mother">Mother's Full
                                        name</label>
                                    <input type="text" id="mother" disabled
                                        class="form-control form-control-sm @error('mother') is-invalid @enderror"
                                        name="mother" wire:model.live="mother" />
                                    @error('mother')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <form >
                                @csrf
                                @method('PUT')
                            <div class="row">
                                <h4 class="fw-bold fs-5">III. Scholarships</h4>
                                <div class="row">
                                    <!-- First Group -->
                                    <div class="col-md-6 px-5">
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
                            </div>
                            {{-- end --}}

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
