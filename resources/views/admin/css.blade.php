<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Admin</title>
<!-- plugins:css -->
{{--
<link rel="stylesheet" href="admin/vendors/simple-line-icons/css/simple-line-icons.css"> --}}
{{--
<link rel="stylesheet" href="admin/vendors/flag-icon-css/css/flag-icon.min.css"> --}}
{{--
<link rel="stylesheet" href="admin/vendors/css/vendor.bundle.base.css"> --}}
<!-- endinject -->
<!-- Plugin css for this page -->
{{--
<link rel="stylesheet" href="./admin/vendors/daterangepicker/daterangepicker.css"> --}}
{{--
<link rel="stylesheet" href="./admin/vendors/chartist/chartist.min.css">/ --}}
<!-- End plugin css for this page -->
<!-- inject:css -->
<!-- endinject -->
<!-- Layout styles -->
<link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

<!-- End layout styles -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .bg-pink {
        background-color: #e83e8c;
        color: white;
    }

    .bg-orange {
        background-color: #fd7e14;
        color: white;
    }

    .bg-teal {
        background-color: #20c997;
        /* Teal color */
        color: white;
    }

    .bg-cyan {
        background-color: #17a2b8;
        /* Cyan color */
        color: white;
    }


    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination li a,
    .pagination li span {
        display: inline-block;
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        color: #333;
        text-decoration: none;
        font-size: 20px;
        /* Adjust size */
    }

    .pagination li a:hover {
        background-color: #f0f0f0;
        border-color: #ccc;
    }

    .pagination .active span {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
        font-weight: bold;
    }

    .pagination .disabled span {
        color: #aaa;
        pointer-events: none;
        border-color: #ddd;
    }

    @media (max-width: 991.98px) {
        .sidebar {
            position: fixed;
            left: -260px;
            top: 0;
            height: 100%;
            width: 260px;
            z-index: 1050;
            transition: left 0.3s ease;
        }

        .sidebar.active {
            left: 0;
        }
    }
</style>
