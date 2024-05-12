<div>
    <style>
        .link {
            color: black;
            text-decoration: none;
        }

        .link:hover {
            color: blue;
            text-decoration: underline;
        }

        .card-body {
            max-width: 25rem;
            height: 15rem;
        }
    </style>


    <div class="row">

        <!-- Government Scholarships -->
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-sm">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="fas fa-landmark fa-2x"></i> <!-- Changed icon -->
                    </h2>
                    <h4 class="mb-3 mt-4 d-flex align-items-start">
                        <a class="link" href="{{ url('scholarView?scholarship_type=0') }}">
                            <small class="mb-0">Government</small>
                            <span class="option ml-2">Scholarships</span>
                        </a>
                    </h4>
                    <h5 class="card-text fs-4">{{ $government }}</h5>
                </div>
            </div>
        </div>

        <!-- Private Scholarships -->
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-sm">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="fas fa-handshake fa-2x"></i> <!-- Changed icon -->
                    </h2>

                    <h4 class="mb-3 mt-4 d-flex align-items-start">
                        <a class="link" href="{{ url('scholarView?scholarship_type=1') }}">
                            <small class="mb-0">Private</small>
                            <span class="option ml-2"> Scholarships</span>
                        </a>
                    </h4>
                    <h5 class="card-text fs-4">{{ $private }}</h5>

                </div>
            </div>
        </div>


        <!-- Active Government Scholarships -->
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-sm">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="fas fa-university fa-2x"></i> <!-- Icon representing educational institutions -->
                    </h2>
                    <h4 class="mb-3 mt-4 d-flex align-items-start">
                        <a class="link" href="{{ url('scholarView?scholarship_type=0&status=1') }}">
                            <small class="mb-0">Active</small>
                            <span class="option ml-1">Government Scholarships</span>
                        </a>
                    </h4>
                    <h5 class="card-text fs-4">{{ $governmentActive }}</h5>
                </div>
            </div>
        </div>

        <!-- Active Private Scholarships -->
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-light card-img-holder text-dark shadow-sm">
                <div class="card-body">
                    <h2 class="font-weight-normal mb-3">
                        <i class="fas fa-hand-holding-usd fa-2x"></i> <!-- Icon representing financial support -->
                    </h2>
                    <h4 class="mb-3 mt-4 d-flex align-items-start">
                        <a class="link" href="{{ url('scholarView?scholarship_type=1&status=1') }}">
                            <small class="mb-0">Active</small>
                            <span class="option ml-2">Private Scholarships</span>
                        </a>
                    </h4>
                    <h5 class="card-text fs-4">{{ $privateActive }}</h5>
                </div>
            </div>
        </div>



        <div class="row">
            <!-- Government Grantees -->
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-light card-img-holder text-dark shadow-sm">
                    <div class="card-body">
                        <h2 class="font-weight-normal mb-3">
                            <i class="fas fa-user-graduate fa-2x"></i> <!-- Icon representing a graduate -->
                        </h2>
                        <h4 class="mb-3 mt-4 d-flex align-items-start">
                            <a class="link" href="{{ route('viewGrantee.government') }}">
                                <span class="option">Government Grantees</span>
                            </a>
                        </h4>
                        <h5 class="card-text fs-4">{{ $governmentStudent }}</h5>
                    </div>
                </div>
            </div>

            <!-- Private Grantees -->
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-light card-img-holder text-dark shadow-sm">
                    <div class="card-body">
                        <h2 class="font-weight-normal mb-3">
                            <i class="fas fa-users fa-2x"></i> <!-- Icon representing a group of people -->
                        </h2>
                        <h4 class="mb-3 mt-4 d-flex align-items-start">
                            <a class="link" href="{{ route('viewGrantee.private') }}">
                                <span class="option ml-2">Private Grantees</span>
                            </a>
                        </h4>
                        <h5 class="card-text fs-4">{{ $privateStudent }}</h5>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
