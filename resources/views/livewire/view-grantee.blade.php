<div>
    <section class="p-2">
        <div class="row">
            
            <div class="col-12 col-md-12 col-lg-12">
                <div class="d-flex align-items-center mb-2">
                    <a class="btn btn-warning btn-sm fw-bold" href="{{ url('viewGrantee') }}">Reset</a>
                </div>
                @if(request()->routeIs('view-grantee'))
                <livewire:student-grantee />
                @endif

                @if(request()->routeIs('viewGrantee.government'))
                <livewire:student-grantee-filter />
                @endif

                @if(request()->routeIs('viewGrantee.private'))
                <livewire:student-grantee-private/>
                @endif
            </div>
        </div>
    </section>
</div>