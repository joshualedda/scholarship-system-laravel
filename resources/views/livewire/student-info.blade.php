<div>
    <section class="mt-2 p-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="text-align: center; font-size:25px; font-weight: bold;">
                        Student Data
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="saveStudent" class="row g-3">
                            @csrf
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
                                    <div class="alert alert-danger lert-dismissible fade show" role="alert">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <span>No record of the student.</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
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
                            <div class="form-group mt-1">
                                <label for="campus-selection" class="fw-bold fs-5 mb-2">CAMPUS:</label>
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-2">
                                    <div class="col">
                                        @foreach ($campuses as $campus)
                                        <label class="form-check-label" for="selectedCampus">
                                            <input class="form-check-input campus-radio" type="radio"
                                                wire:model.live="selectedCampus" value="{{ $campus->id }}"
                                                id="selectedCampus" name="selectedCampus">
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
                                            style="margin-right: 5px;"> {{ $type }}
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
                                    id="nameSchool" wire:model.live="nameSchool">
                                <label for="lastYear"><span class="text-danger">*</span> School year last
                                    attended:</label>
                                <input type="text" class="form-control form-control-sm" name="lastYear" id="lastYear"
                                    wire:model.live="lastYear">
                            </div>


                            <div class="row">
                                <p class="fw-bold fs-5">I. STUDENT INFORMATION</p>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label" for="lastname">Last name</label>
                                    <input type="text" id="lastname"
                                        class="form-control form-control-sm @error('lastname') is-invalid @enderror"
                                        wire:model.live="lastname" name="lastname" />
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
                                        wire:model.live="firstname" name="firstname" />
                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label" for="initial">Middle Initial</label>
                                    <input type="text" id="initial"
                                        class="form-control form-control-sm @error('initial') is-invalid @enderror"
                                        wire:model.live="initial" name="initial" />
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
                                    <select class="form-select form-select-sm" wire:model.live="selectedProvince"
                                        name="selectedProvince">
                                        <option value="" >Select Province</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->provCode }}" @if($province->provCode == $selectedProvince) selected @endif >{{ $province->provDesc }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedProvince')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label">City/Municipality</label>
                                    <select class="form-select form-select-sm" wire:model.live="selectedMunicipality"
                                        name="selectedMunicipality">
                                        <option value="" >Select City/Municipality</option>
                                        @foreach ($municipalities as $municipality)
                                            <option value="{{ $municipality->citymunCode }}" @if($municipality->citymunCode == $selectedMunicipality) selected @endif >{{ $municipality->citymunDesc }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedMunicipality')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label">Barangay</label>
                                    <select class="form-select form-select-sm" wire:model.live="selectedBarangay"
                                        name="selectedBarangay">
                                        <option value="" >Select Barangay</option>
                                        @foreach ($barangays as $barangay)
                                            <option value="{{ $barangay->brgyCode }}" @if($barangay->brgyCode == $selectedBarangay) selected @endif >{{ $barangay->brgyDesc }}</option>
                                        @endforeach
                                    </select>
                                    @error('selectedBarangay')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- sex here --}}
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="fw-bold mx-5">Sex:</div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('sex') is-invalid @enderror mx-2"
                                                type="radio" id="male" value="Male" wire:model="sex" name="sex">
                                            <label class="form-check-label m-0" for="male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('sex') is-invalid @enderror"
                                                type="radio" id="female" value="Female" wire:model="sex" name="sex">
                                            <label class="form-check-label m-0" for="female">Female</label>
                                        </div>
                                        @error('sex')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="fw-bold mx-5">Civil Status:</div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('status') is-invalid @enderror"
                                                type="radio" id="single" value="Single" wire:model="status" name="status">
                                            <label class="form-check-label m-0" for="single">Single</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('status') is-invalid @enderror"
                                                type="radio" id="married" value="Married" wire:model="status" name="status">
                                            <label class="form-check-label m-0" for="married">Married</label>
                                        </div>
                                        @error('status')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-3 position-relative mt-3">
                                    <label class="form-label" for="contact">Contact
                                        Number</label>
                                    <input type="text" id="contact"
                                        class="form-control form-control-sm @error('contact') is-invalid @enderror"
                                        wire:model.live="contact" maxlength="11" minlength="11" name="contact" />
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
                                        wire:model.live="email" name="email" />
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
                                        class="@error('level') is-invalid @enderror form-select form-select-sm text-center"
                                        wire:model.live="level">
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


                                <div class="col-md-6 position-relative mt-0">
                                    <label class="form-label">Course</label>
                                    <select class="form-select form-select-sm" id="selectedCourse" name="selectedCourse"
                                        wire:model.live="selectedCourse">
                                        <option selected>Select Course</option>
                                        @foreach ($courses as $course)
                                        <option value="{{ $course->course_id }}" @if($course->course_id == $selectedCourse) selected @endif >{{ $course->course_name }}
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
                            <hr>

                            {{-- family --}}
                            <div class="row mb-4">
                                <p class="fw-bold fs-5">II. FAMILY INFORMATION</p>

                                <div class="col-md-6 position-relative mt-0">
                                    <label class="form-label" for="father" name="father">Father's Full
                                        name</label>
                                    <input type="text" id="father"
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
                                    <input type="text" id="mother"
                                        class="form-control form-control-sm @error('mother') is-invalid @enderror"
                                        name="mother" wire:model.live="mother" />
                                    @error('mother')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- end --}}
                            <div class="row mt-3">
                                <div class="col-md-6 d-flex justify-content-center gap-4">
                                    <button type="submit" wire:click='resetForm'
                                        class="btn btn-warning btn-md fw-bold text-dark mt-2">
                                        <i class="mdi mdi-close"></i>
                                        Reset
                                    </button>
                                    <button type="submit" wire:loading.attr='disabled'
                                        class="btn btn-success btn-md fw-bold text-dark mt-2">
                                        <i class="mdi mdi-content-save"></i>
                                        Save
                                    </button>
                                    <a type="button" class="btn btn-danger btn-md fw-bold text-dark mt-2"
                                        href="{{ url('student') }}">
                                        <i class="mdi mdi-close-circle"></i>
                                        Cancel
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    {{-- Display success message --}}
                                    @if (session()->has('success'))
                                    <div class="alert alert-success text-center">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                    @if (session()->has('error'))
                                    <div class="alert alert-danger text-center">
                                        {{ session('error') }}
                                    </div>
                                    @endif
                                    {{-- ends here --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
