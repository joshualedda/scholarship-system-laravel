<div>

    <div class="pagetitle">
        <h1>Users List</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item">Users</li>
            </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-end my-2">
        <a href="{{ url('registerUser') }}" class="btn btn-primary">
            Add User Accounts
        </a>
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
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email Address</th>
                            <th>User Type</th>
                            <th>Campus</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->getRoleText() }}</td>
                            <td>{{ $user->getCampus() }}</td>
                            <td>
                                <a href="{{ url('/updateAccount', ['userId' => $user->id]) }}" type="button" class="btn btn-primary btn-sm rounded-full">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        // new DataTable('#example');
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
</div>
