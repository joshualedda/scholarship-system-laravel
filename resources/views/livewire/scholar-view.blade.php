<div>
    <section class="mt-2 p-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="d-flex align-items-end justify-content-end m-2 gap-2">
                        <!-- Add Button -->
                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                            data-bs-target="#modal">
                            Add <i class="mdi mdi-library-plus mdi-20"></i>
                        </button>
                        <a href="{{ url('scholarView') }}" class="btn btn-sm btn-warning">
                            Reset <i class="mdi mdi-rotate-left mdi-20"></i>
                        </a>
                        <a class="btn btn-sm btn-danger" href="{{ url('dashboard') }}">
                            Cancel <i class="mdi mdi-close-circle mdi-20"></i>
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true"
                            wire:ignore.self>
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalLabel">Scholarship Name</h1>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form wire:submit.prevent="addScholarship">
                                            @if (session()->has('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                            @endif
                                            @csrf
                                            <!-- Your form fields go here -->
                                            <div class="form-check">
                                                <label for="scholarship_type_id" class="mb-2">Scholarship
                                                    Type</label>
                                                <select wire:model.live="scholarship_type_id" name="scholarship_type_id"
                                                    id="scholarship_type_id" class="form-select form-select-sm mb-2">
                                                    <option selected>Select Scholarship Type</option>
                                                    <option value="0">Government</option>
                                                    <option value="1">Private</option>
                                                </select>
                                                @error('scholarship_type_id') <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-check">
                                                <label for="scholarship_name" class="mb-2">Scholarship Name
                                                    <font class="text-danger">*</font>
                                                </label>
                                                <input wire:model.live="scholarship_name"
                                                    class="form-control form-control-sm mb-2" type="text"
                                                    id="scholarship_name">
                                                @error('scholarship_name') <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <!-- End of your form fields -->
                                            <div class="modal-footer d-flex justify-content-start align-items-start">
                                                <div>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success btn-sm">Add</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Modal End --}}

                    </div>
                    <div class="card-body shadow-lg">
                        <div id="datatable">
                            <!-- DataTable with export buttons -->
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Scholarship Name</th>
                                        <th>Scholarship Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $scholarships as $scholarship )
                                    <tr>
                                        <td>{{ $scholarship->name }}</td>
                                        <td>{{ $scholarship->getTypeScholarshipAttribute() }}</td>
                                        <td>{{ $scholarship->getStatusScholarshipNameAttribute() }}</td>
                                        <td>
                                            <a href="{{ url('scholarEdit', ['scholar' => $scholarship->id]) }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready( function () {
            $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                extend: 'excel',
                text: 'Excel',
                className: 'btn btn-sm btn-success'
                },
                {
                extend: 'pdf',
                text: 'PDF',
                className: 'btn btn-sm btn-danger'
                }
            ]
            });
        } );
    </script>
</div>