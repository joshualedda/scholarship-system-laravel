<div>
    <section class="p-2">
        <div class="row">
            <div class="col-12 com-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ 'Edit: ' . $scholarName->name}}
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="updateScholar">
                            @csrf
                            <div class="mb-3">
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
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="scholarship_type_id" class="form-label">Scholarship Type</label>
                                        <select type="text" class="form-select form-select-sm"
                                            id="scholarship_type_id" name="scholarship_type_id"
                                            wire:model.live="scholarship_type_id">
                                            <option value="0">Government</option>
                                            <option value="1">Private</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="scholarship_name" class="form-label">Scholarship Name</label>
                                        <input type="text" class="form-control form-control-sm" id="scholarship_name"
                                            name="scholarship_name" wire:model.live="scholarship_name">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select type="text" class="form-select form-select-sm" id="status"
                                            name="status" wire:model.live="status">
                                            <option value="0">Active</option>
                                            <option value="1">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ url('scholarView') }}" type="submit" class="btn btn-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>