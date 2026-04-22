<div class="row purchace-popup">
    <div class="col-12 stretch-card grid-margin">
        <div class="card card-secondary">
            <span class="card-body d-lg-flex align-items-center">
                <p class="mb-lg-0">WELCOME BACK! </p>
                <button class="close popup-dismiss ml-2">
                    <span aria-hidden="true">&times;</span>
                </button>
            </span>
        </div>
    </div>
</div>
<!-- Quick Action Toolbar Starts-->
<div class="row quick-action-toolbar">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-header d-block d-md-flex">
                <h5 class="mb-0">Quick Actions</h5>
                <p class="ml-auto mb-0">We have prepared your dashboard<i class="icon-bulb"></i></p>
            </div>
            <div class="d-md-flex row m-0 quick-action-btns" role="group" aria-label="Quick action buttons">
                <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                    <a href="{{ url('categories') }}" class="btn px-0">
                        <i class="icon-docs mr-2"></i> Add Categories
                    </a>
                </div>
                <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                    <a href="{{ url('pillars') }}" class="btn px-0">
                        <i class="icon-docs mr-2"></i> Add Pillars
                    </a>
                </div>
                <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                    <a href="{{ url('categories') }}" class="btn px-0">
                        <i class="icon-book-open mr-2"></i> View Categories
                    </a>
                </div>
                <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                    <a href="{{ url('pillars') }}" class="btn px-0">
                        <i class="icon-book-open mr-2"></i> View Pillars
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick Action Toolbar Ends-->
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <!-- Fixed Header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-sm-flex align-items-baseline report-summary-header"
                            style="position: sticky; top: 0; z-index: 10; background: white;">
                            <h5 class="font-weight-semibold mb-4">Report Summary</h5>
                            <span class="ml-auto">
                                <a href="{{ url('/redirect') }}" class="btn btn-icons border-0 p-2"
                                    style="text-decoration:underline; color:red; cursor:pointer">
                                    <i class="icon-refresh"></i> Refresh Report
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Scrollable Content -->
                <div class="row" style="max-height: 40rem; overflow-y: auto;">
                    @foreach ($categories as $category)
                    @php
                    $colors = ['bg-primary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-dark', 'bg-teal',
                    'bg-pink',
                    'bg-orange', 'bg-cyan'];
                    @endphp
                    <div class="col-md-2 d-flex">
                        <div class="p-3 border rounded shadow-sm w-100 {{ $colors[$loop->index % count($colors)] }}"
                            style="color: white;">
                            <div class="inner-card-text">
                                <h6 class="report-title mb-2">{{ $category->category_name }}</h6>
                                <span class="report-count text-light">{{ $category->pillars_count }} Pillar(s)</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>