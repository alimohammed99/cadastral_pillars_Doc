{{-- <!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        @include('admin.pillars_styles');
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('admin.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('admin.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="card">
                        <div class="card-header">
                            <h4>Category Pillars</h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('pillars') }}" class="btn btn-secondary mb-3">Back to All Categories</a>

                            <!-- Pillars Table -->
                            @if($pillars->isEmpty())
                            <p>No pillars available for this category.</p>
                            @else
                            @include('admin.pillars_table', ['pillars' => $pillars, 'category' => $category])
                            @endif
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    @include('admin.script')

</body>

</html> --}}
