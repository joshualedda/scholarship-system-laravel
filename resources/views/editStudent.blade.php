@extends('layouts.includes.index')
@section('content')

<section class="mt-2 p-1">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="text-align: center; font-size:25px; font-weight: bold;">
                    Student Data
                </div>
                <div class="card-body">
                    <form action="{{ route('student.update', $student->id ) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="student_id">Student ID</label>
                                    <div class="input-group">
                                        <input type="text" id="student_id" class="form-control form-control-sm"
                                            name="student_id" maxlength="10" aria-describedby="studentIdHelp"
                                            value="{{ $student->student_id }}">
                                    </div>
                                </div>


                                {{-- id end --}}
                            </div>
                            <div class="form-group mt-1">
                                <label for="campus-selection" class="fw-bold fs-5 mb-2">CAMPUS:</label>
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-2">
                                    <div class="col">
                                        @foreach ($campuses as $campus)
                                        <label class="form-check-label" for="campus{{ $campus->id }}">
                                            <input class="form-check-input campus-radio" type="radio"
                                                name="selectedCampus" value="{{ $campus->id }}"
                                                id="campus{{ $campus->id }}" {{ $student->campus == $campus->id ?
                                            'checked' : '' }}>
                                            {{ $campus->campus_name }}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>



                            <hr class="w-50">

                            <div class="row mt-2 mb-2 row-cols-1 row-cols-sm-2 row-cols-md-2 g-2">
                                <div class="col">
                                    @foreach (['New', 'Continuing', 'Returning Student'] as $type)
                                    <label class="form-check-label">
                                        <input class="form-check-input @error('studentType') is-invalid @enderror"
                                            type="radio" name="studentType" id="check{{ $type }}" value="{{ $type }}"
                                            style="margin-right: 5px;" {{ $student->studentType == $type ? 'checked' :
                                        '' }}>
                                        {{ $type }}
                                    </label>
                                    @endforeach
                                    @error('studentType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-md-4 mx-3 my-1" id="newInput"">
                            <label for=" nameSchool"><span class="text-danger">*</span> If new, indicate name of
                                school last attended:</label>
                                <input type="text" class="form-control form-control-sm" name="nameSchool"
                                    id="nameSchool">
                                <label for="lastYear"><span class="text-danger">*</span> School year last
                                    attended:</label>
                                <input type="text" class="form-control form-control-sm" name="lastYear" id="lastYear">
                            </div>


                            <div class="row">
                                <p class="fw-bold fs-5">I. STUDENT INFORMATION</p>

                                <div class="col-md-4 position-relative mt-0">
                                    <label class="form-label" for="lastname">Last name</label>
                                    <input type="text" id="lastname" value="{{ $student->lastname }}"
                                        class="form-control form-control-sm @error('lastname') is-invalid @enderror"
                                        name="lastname" />
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
                                        name="firstname" value="{{ $student->firstname }}" />
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
                                        name="initial" value="{{ $student->initial }}" />
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
                                    <select class="form-select form-select-sm" name="selectedProvince">
                                        <option value="">Select Province</option>
                                        @foreach ($provinces as $province)
                                        <option value="{{ $province->provCode }}" >{{ $province->provDesc }}</option>
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
                                    <select class="form-select form-select-sm" name="selectedMunicipality" >
                                        <option value="">Select City/Municipality</option>
                                        @foreach ($municipalities as $municipality)
                                        <option value="{{ $municipality->citymunCode }}" >{{ $municipality->citymunDesc }}
                                        </option>
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
                                    <select class="form-select form-select-sm" name="selectedBarangay">
                                         <option value="">Select Barangay</option>
                                        @foreach ($barangays as $barangay)
                                        <option value="{{ $barangay->brgyCode }}" >{{ $barangay->brgyDesc }}</option>
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
                                        <label for="sex" class="fw-bold mx-5">Sex:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('sex') is-invalid @enderror mx-2"
                                                type="radio" id="male" value="Male" name="sex" {{ $student->sex ===
                                            'Male' ? 'checked' : '' }}>
                                            <label class="form-check-label m-0" for="male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('sex') is-invalid @enderror"
                                                type="radio" id="female" value="Female" name="sex" {{ $student->sex ===
                                            'Female' ? 'checked' : '' }}>
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
                                        <label for="status" class="fw-bold mx-5">Civil Status:</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('status') is-invalid @enderror"
                                                type="radio" id="single" value="Single" name="status" {{
                                                $student->status === 'Single' ? 'checked' : '' }} >
                                            <label class="form-check-label m-0" for="status">Single</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input @error('status') is-invalid @enderror"
                                                type="radio" id="married" value="Married" name="status" {{
                                                $student->status === 'Married' ? 'checked' : '' }} >
                                            <label class="form-check-label m-0" for="status">Married</label>
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
                                    <input type="text" id="contact" value="{{ $student->contact }}"
                                        class="form-control form-control-sm @error('contact') is-invalid @enderror"
                                        maxlength="11" minlength="11" name="contact" />
                                    @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- Email -->
                                <div class="col-md-3 position-relative mt-3">
                                    <label class="form-label" for="email">Email Address</label>
                                    <input type="email" id="email" value="{{ $student->email }}"
                                        class="form-control form-control-sm @error('email') is-invalid @enderror"
                                        name="email" />
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- sex end --}}
                        </div>



                        <div class="row mt-2 mb-2">
                            <div class="col-md-3 position-relative mt-0">
                                <label class="form-label">Year level</label>
                                <select id="level"
                                    class="@error('level') is-invalid @enderror form-select form-select-sm text-center"
                                    name="level">
                                    <option value="" selected>Select year level</option>
                                    @foreach (['1', '2', '3', '4', '5', '6'] as $yearLevel)
                                    <option value="{{ $yearLevel }}" {{ $student->level == $yearLevel ? 'selected' : ''
                                        }}>
                                        {{ $yearLevel }}
                                    </option>
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
                                <select class="form-select form-select-sm" id="selectedCourse" name="selectedCourse">
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



                </div>
                {{-- family --}}
                <div class="row mb-4 p-3">
                    <p class="fw-bold fs-5">II. FAMILY INFORMATION</p>

                    <div class="col-md-6 position-relative mt-0">
                        <label class="form-label" for="father" name="father">Father's Full
                            name</label>
                        <input type="text" id="father" value="{{ $student->father }}"
                            class="form-control form-control-sm @error('father') is-invalid @enderror" name="father" />
                        @error('father')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6 position-relative mt-0">
                        <label class="form-label" for="mother" name="mother">Mother's Full
                            name</label>
                        <input type="text" id="mother" value="{{ $student->mother }}"
                            class="form-control form-control-sm @error('mother') is-invalid @enderror" name="mother" />
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
                        <button type="submit" class="btn btn-success btn-md fw-bold text-dark mt-2">
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

<script>
    $(document).ready(function() {
    $('#province').change(function() {
        var selectedProvince = $(this).val();
        $.ajax({
            type: 'GET',
            url: "{{ route('get.municipalities') }}",
            data: { province: selectedProvince },
            success: function(response) {
                console.log("TSt");
                $('#municipality').empty();
                $.each(response, function(key, value) {
                    $('#municipality').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });

    $('#municipality').change(function() {
        var selectedMunicipality = $(this).val();
        $.ajax({
            type: 'GET',
            url: "{{ route('get.barangays') }}",
            data: { municipality: selectedMunicipality },
            success: function(response) {
                $('#barangay').empty();
                $.each(response, function(key, value) {
                    $('#barangay').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });
});

</script>

@endsection