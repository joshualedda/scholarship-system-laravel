<div>
    <section class="p-5">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header text-center">
                            <h3 class="card-title">Add School Year</h3>
                            <p class="card-subtitle mb-2 text-muted">Enter the new school year to be added to the system.</p>
                        </div>                          
                        <form wire:submit.prevent='addYear'>
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="year" class="form-label">School Year</label>
                                    <input type="text" class="form-control form-control-md @error('year') is-invalid @enderror"
                                        name="year" id="year" maxlength="9" wire:model.live='year'>
                                    @error('year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <small class="my-2">Note: <span class="text-danger">e.g., (2020-2021)</span></small>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-start justify-content-start"> 
                                <button type="submit" class="btn btn-md btn-primary btn-rounded">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
