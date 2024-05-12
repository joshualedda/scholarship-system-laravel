@extends('layouts.includes.index')
@section('content')

<div class="pagetitle">
    <h1>Add User </h1>
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
            @method('POST')
            @csrf

            <div class="col-md-6">
                <label class="form-label">User Type<span class="text-danger">*</span></label>
                <input class="form-control" type="text" required name="user_type" />
            </div>

            <div class="col-md-6">
                <label class="form-label">Name<span class="text-danger">*</span></label>
                <input class="form-control" type="text" required name="name" />
            </div>


            <div class="col-md-6">
                <label class="form-label">Status<span class="text-danger">*</span></label>
                <select class="form-select" name="status" required>
                    <option selected value="">Choose from below</option>
                    <option value="0">Active</option>
                    <option value="1">Inactive</option>
                </select>
            </div>

            <div class="col-12 d-flex justify-content-end align-items-center">
                <!-- <span id="message" class="text-success text-sm"></span> -->
                <button class="btn btn-success mt-2 ml-2" type="submit" name="submit" id="submitUser">Add User Type</button>
            </div>


        </form>

    </div>
</div>
</div>



@endsection

