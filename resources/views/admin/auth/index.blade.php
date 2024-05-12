@extends('layouts.includes.index')
@section('content')



    <div class="pagetitle">
        <h1>Users Types</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item">Users</li>
            </ol>
        </nav>
    </div>



    <div class="d-flex justify-content-end my-2">
        <a href="{{ route('usertype.create') }}" class="btn btn-primary">Add</a>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Users Data</h5>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable table-striped table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th>User Type</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usersList as $user)
                                    <tr>
                                        <td>{{ $user->user_type }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->status == 0 ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('usertype.show', $user->id) }}" class="btn-sm btn btn-primary">View</a>
                                            <a href="{{ route('usertype.edit', $user->id) }}" class="btn-sm btn btn-primary">Edit</a>
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
    $(document).ready(function () {
        $(document).on('click', '.accept-btn', function () {
            var userId = $(this).data('id');
            var button = $(this);

            $.ajax({
                url: '../admin/updateStatus.php',
                method: 'POST',
                data: { userId: userId },
                success: function (response) {
                    console.log(response);
                    $('#liveToast').removeClass('hide');
                    $("#messageResponse").html("Status Updated Successfully.");
                    $('.toast').toast(' ow');
                    button.remove();

                    // for the status//it's still not working
                    $('#datatable .user-status').html('<span class="badge bg-success">Active</span>');

                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    $("#messageResponse").html("Something went wrong.");
                    $('#liveToast').removeClass('hide');
                    $('.toast').toast('show');
                }
            });
        });
    });
</script>



@endsection

