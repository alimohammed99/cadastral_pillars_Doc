<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        @include('admin.pillars_styles');

        /* Professional Button Styling */
        .btn {
            cursor: pointer !important;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        /* Search Bar Refinement */
        .search-wrapper {
            background: #fff;
            border: 1.5px solid #edf2f7;
            border-radius: 12px;
            padding: 2px 10px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            max-width: 320px;
        }

        .search-wrapper:focus-within {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        }

        .pillar-search {
            border: none !important;
            box-shadow: none !important;
            padding: 10px 5px !important;
            font-size: 0.9rem;
        }

        /* Modal Position Fix */
        .modal.fade .modal-dialog {
            margin-top: 3rem;
        }

        .btn-back {
            background-color: #f8f9fa;
            color: #4a5568 !important;
            border: 1px solid #e2e8f0;
            text-decoration: none !important;
            font-size: 0.85rem;
        }

        .pillar-badge {
            font-size: 11px;
            padding: 5px 11px;
            border-radius: 999px;
            font-weight: 500;
            display: inline-block;
        }

        .pillar-main {
            background: linear-gradient(145deg, #f1f3f5, #ffffff);
            color: #0d6efd;
            border: 1px solid rgba(13, 110, 253, 0.2);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
            animation: floatLive 1.6s ease-in-out infinite;
        }

        .pillar-extra {
            background: #e9ecef;
            color: #495057;
            border: 1px dashed #ced4da;
            animation: pulseLive 2s ease-in-out infinite;
        }

        /*  visible floating */
        @keyframes floatLive {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        /* clearer pulse */
        @keyframes pulseLive {

            0%,
            100% {
                opacity: 0.7;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.15);
            }
        }

        /* Table base */
        .engineered-table {
            font-size: 13px;
            border-collapse: separate;
            border-spacing: 0;
        }

        /* Header glow */
        .engineered-table thead th {
            font-size: 11px;
            letter-spacing: 0.5px;
            color: #6c757d;
            background: linear-gradient(180deg, #fbfcfe, #ffffff);
            position: sticky;
            top: 0;
            z-index: 3;
            border-bottom: 1px solid #eef2f6;
        }

        /* Row energy */
        .engineered-table tbody tr {
            transition: all 0.25s ease;
            position: relative;
        }

        /* Hover = energy wave */
        .engineered-table tbody tr:hover {
            background: radial-gradient(circle at center, rgba(13, 110, 253, 0.06), transparent 70%);
            transform: translateY(-1px);
        }

        /* Pillar glow core */
        .core-pill {
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            color: #0d6efd;
            background: rgba(13, 110, 253, 0.08);
            border: 1px solid rgba(13, 110, 253, 0.18);
            box-shadow: 0 0 10px rgba(13, 110, 253, 0.08);
            animation: pulseCore 2.8s ease-in-out infinite;
        }

        /* coordinate energy */
        .coord {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas;
            font-size: 12.5px;
            color: #495057;
            animation: softFlicker 4s ease-in-out infinite;
        }

        /* subtle glow pulse */
        @keyframes pulseCore {

            0%,
            100% {
                box-shadow: 0 0 8px rgba(13, 110, 253, 0.08);
            }

            50% {
                box-shadow: 0 0 18px rgba(13, 110, 253, 0.18);
            }
        }

        /* soft data shimmer */
        @keyframes softFlicker {

            0%,
            100% {
                opacity: 0.85;
            }

            50% {
                opacity: 1;
            }
        }

        /* edge highlight line */
        .engineered-table tbody tr::before {
            /* content: ""; */
            /* position: absolute; */
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(180deg, transparent, rgba(13, 110, 253, 0.4), transparent);
            opacity: 0;
            transition: 0.3s;
        }

        .engineered-table tbody tr:hover::before {
            opacity: 1;
        }

        /* Card refinement */
        .coord-card {
            border-radius: 18px;
            border: 1px solid #eef2f6 !important;
            background: #ffffff;
            overflow: hidden;
        }

        /* Header upgrade */
        .coord-header {
            background: linear-gradient(180deg, #ffffff, #fbfcfe);
            border-bottom: 1px solid #f1f3f5;
        }

        /* Table feel */
        .engineered-table {
            font-size: 13px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .engineered-table thead th {
            font-size: 11px;
            letter-spacing: 0.6px;
            color: #6c757d;
            background: #fbfcfe;
            border-bottom: 1px solid #eef2f6;
            /* position: sticky; */
            top: 0;
            z-index: 2;
        }

        /* Row presence */
        .engineered-table tbody tr {
            transition: all 0.22s ease;
        }

        .engineered-table tbody tr:hover {
            background: rgba(13, 110, 253, 0.04);
            transform: translateY(-1px);
        }

        /* Pillar core (premium node style) */
        .core-pill {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            color: #0d6efd;
            background: rgba(13, 110, 253, 0.08);
            border: 1px solid rgba(13, 110, 253, 0.18);
            box-shadow: 0 0 12px rgba(13, 110, 253, 0.06);
            animation: softPulse 3.2s ease-in-out infinite;
        }

        /* coordinate text */
        .coord {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas;
            font-size: 12.5px;
            color: #495057;
            letter-spacing: 0.2px;
            opacity: 0.9;
            transition: 0.2s ease;
        }

        /* subtle glow life */
        @keyframes softPulse {

            0%,
            100% {
                box-shadow: 0 0 8px rgba(13, 110, 253, 0.05);
            }

            50% {
                box-shadow: 0 0 16px rgba(13, 110, 253, 0.14);
            }
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('admin.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('admin.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @include('admin.message_feedback')
                    <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                        <div
                            class="card-header bg-transparent border-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                            <h4 class="fw-bold mb-0">Category: <span
                                    class="text-primary">{{ $category->category_name }}</span></h4>
                            <a href="{{ route('pillars') }}" class="btn btn-back px-3">
                                <i class="icon-arrow-left"></i> All Categories
                            </a>
                        </div>

                        <div class="card-body px-4 pt-4">
                            {{-- Action buttons --}}
                            <div
                                class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                                <div class="d-flex flex-wrap gap-2">
                                    <!-- Add Pillar Button -->
                                    <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal"
                                        data-bs-target="#addPillarModal" data-category-id="{{ $category->id }}">
                                        <i class="icon-plus"></i> Add Pillar
                                    </button>

                                    <!-- Choose Excel File Button -->
                                    <button type="button" class="btn btn-outline-danger px-4" data-bs-toggle="modal"
                                        data-bs-target="#uploadExcelModal">
                                        <i class="icon-cloud-upload"></i> Import Excel
                                    </button>

                                    <!-- Export to Excel Button -->
                                    <a href="{{ route('export.pillars') }}" class="btn btn-success px-4">
                                        <i class="icon-share-alt"></i> Export
                                    </a>
                                </div>

                                <!-- Search Input -->
                                <div class="search-wrapper d-flex align-items-center">
                                    <i class="icon-magnifier text-muted ms-2"></i>
                                    <input type="text" class="form-control pillar-search"
                                        placeholder="Search by name, plan..." data-category-id="{{ $category->id }}">
                                </div>
                            </div>

                            <!-- Pillars Table -->
                            @if ($pillars->isEmpty())
                                <p>No pillars available for this category.</p>
                            @else
                                @include('admin.pillars_table', [
                                    'pillars' => $pillars,
                                    'category' => $category,
                                ])
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $pillars->appends(request()->query())->links('pagination::bootstrap-4') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Uploading Excel -->
            @include('admin.upload_excel_sheet')

            <!-- Add Pillar Modal -->
            @include('admin.add_pillar_modal', ['categories' => $categories])

            <!-- Edit Pillar Modal -->
            @include('admin.edit_pillar_modal')
        </div>
    </div>

    @include('admin.script')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function filterPillars(categoryId, searchTerm) {
                const table = document.querySelector(`#category-${categoryId}`);
                if (!table) {
                    console.error(`No table found for category ID: ${categoryId}`);
                    return;
                }

                const rows = table.querySelectorAll('tbody tr');
                let visibleRowCount = 0;

                rows.forEach(row => {
                    const name = row.getAttribute('data-name') || '';
                    const pillarNumber = row.getAttribute('data-pillar-number') || '';
                    const planNumber = row.getAttribute('data-plan-number') || '';

                    if (
                        name.includes(searchTerm) ||
                        pillarNumber.includes(searchTerm) ||
                        planNumber.includes(searchTerm)
                    ) {
                        row.style.display = '';
                        visibleRowCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                const noResultsRow = table.querySelector('.no-results');
                if (visibleRowCount === 0) {
                    if (!noResultsRow) {
                        const newRow = document.createElement('tr');
                        newRow.classList.add('no-results');
                        newRow.innerHTML = `
    <td colspan="12">
        <p style="color: red; font-weight: bold; text-align: left;">
            Sorry, no record matched your input!
        </p>
    </td>`;
                        table.querySelector('tbody').appendChild(newRow);
                    } else {
                        noResultsRow.style.display = '';
                    }
                } else if (noResultsRow) {
                    noResultsRow.style.display = 'none';
                }
            }

            document.querySelectorAll('.pillar-search').forEach(input => {
                input.addEventListener('input', event => {
                    const categoryId = event.target.getAttribute('data-category-id');
                    const searchTerm = event.target.value.trim().toLowerCase();
                    filterPillars(categoryId, searchTerm);
                });
            });

            // Auto-open modal after validation error
            const modalId = @json(session('open_modal'));
            if (modalId) {
                const el = document.getElementById(modalId);
                if (el) {
                    const m = new bootstrap.Modal(el);
                    m.show();
                }
            }
        });
    </script>

</body>

</html>
