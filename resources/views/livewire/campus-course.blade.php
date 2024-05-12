<div>
    <section class="p-2">
        <div class="row">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Campus & Courses/Program</h3>
                </div>
                <div class="row p-2 align-items-center justify-content-center">
                    <div class="col-md-6">
                        @if (session('success'))
                        <div class="alert alert-success text-center alert-dismissible fade show" id="success">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center justify-content-center">
                        {{-- Form 1 --}}
                        <div class="col-md-6">
                            <div class="container shadow-lg w-100 h-100">
                                <form wire:submit.prevent='campusAdd'>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="campus" class="form-label">Campus name (abbreviation)</label>
                                            <input type="text" id="campus" class="form-control form-control-sm"
                                                name="campus" required wire:model.live='campus' />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="campusDesc" class="form-label">Campus Description</label>
                                            <input type="text" id="campusDesc" class="form-control form-control-sm"
                                                name="campusDesc" wire:model.live='campusDesc' required />
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row align-items-start justify-content-start m-2">
                                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Form 2 --}}
                        <div class="col-md-6">
                            <div class="container shadow-lg w-100 h-100">
                                <form wire:submit.prevent='courseAdd'>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="campus_select" class="form-label">Campus</label>
                                            <select name="campus_select" id="campus_select"
                                                class="form-select form-select-md" required
                                                wire:model.live='campus_select'>
                                                <option selected>Choose campus from below</option>
                                                @foreach ($campuses as $campus)
                                                <option value="{{ $campus->id }}">{{ $campus->campus_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="course_program" class="form-label">Course/Program</label>
                                            <input type="text" id="course_program" name="course_program"
                                                class="form-control form-control-sm" wire:model.live='course_program'
                                                required>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row align-items-start justify-content-start m-2">
                                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal --}}
        
        <div wire:ignore.self class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Campus</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateCampus">
                        @csrf
                        <div class="mb-3">
                            <label for="editCampus" class="form-label">Campus Name (Abbreviation)</label>
                            <input type="text" id="editCampus" class="form-control form-control-sm"
                                wire:model="editCampus">
                        </div>
                        <div class="mb-3">
                            <label for="editCampusDesc" class="form-label">Campus Description</label>
                            <input type="text" id="editCampusDesc" class="form-control form-control-sm"
                                wire:model="editCampusDesc">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        {{-- end modal --}}

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 col-md-12 col-lg-12">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($campuses as $campus)
                                <tr>
                                    <td>{{ $campus->campus_name }}</td>
                                    <td>{{ $campus->campusDesc }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
                                            Edit
                                        </button>
                                    </td>


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // new DataTable('#example');
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    
        document.addEventListener('livewire:load', function () {
        // Listen for Livewire event to open the modal with data
        Livewire.on('editModal', (campusId, campusName, campusDesc) => {
            // Set data in Livewire component
            Livewire.editCampusId = campusId;
            Livewire.editCampus = campusName;
            Livewire.editCampusDesc = campusDesc;

            // Open the modal
            $('#staticBackdrop').modal('show');
        });

        // Listen for Livewire event to close the modal
        Livewire.on('closeModal', () => {
            $('#staticBackdrop').modal('hide');
        });
    });

    </script>
</div>