@extends('layouts.includes.index')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    User Types
                </div>
                <div class="card-body">
                    <form action="{{ route('userTypes.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">User Type Name:</label>
                            <input type="text" name="name" class="form-control form-control-sm"
                                placeholder="Enter User Type Name">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-2">Create User Type</button>
                    </form>

                    @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
