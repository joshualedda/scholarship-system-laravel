@extends('layouts.includes.index')
@section('content')

<div class="pagetitle">
    <h1>User List Info</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item">User</li>
        </ol>
    </nav>
</div>
<div class="d-flex justify-content-end my-2">
    <a href="{{ route('usertype.list') }}" class="btn btn-success">Back</a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif



<div class="card">
    <div class="card-body">
        <h5 class="card-title">User Information </h5>

        <form class="row g-3" id="addUserForm" action="{{ route('usertype.store') }}" method="POST">


            <div class="col-md-6">
                <label class="form-label">User Type<span class="text-danger">*</span></label>
                <input disabled class="form-control" type="text" required name="user_type" value="{{ $userType->user_type }}"/>
            </div>

            <div class="col-md-6">
                <label class="form-label">Name<span class="text-danger">*</span></label>
                <input disabled class="form-control" type="text" required name="name"  value="{{ $userType->name }}"/>
            </div>


            <div class="col-md-6">
                <label class="form-label">Status<span class="text-danger">*</span></label>
                <select disabled class="form-select" name="status" required>
                    <option value="">Choose from below</option>
                    <option value="0" {{ $userType->status == 0 ? 'selected' : '' }}>Active</option>
                    <option value="1" {{ $userType->status == 1 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>




        </form>

    </div>
</div>
</div>



@endsection

