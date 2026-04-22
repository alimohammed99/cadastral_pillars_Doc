<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        @include('admin.pillars_styles');

        /* Professional Button Styling */
        .btn {
            cursor: pointer !important;
            border: none;
        }

        /* Modal Position Fix - Center and lift */
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            margin-top: 2rem;
        }
        .modal.show .modal-dialog {
            transform: none;
        }

        .btn {
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        /* Enhanced Cancel Button Visibility */
        .btn-cancel {
            background-color: #f8f9fa !important;
            border: 1px solid #dee2e6 !important;
            color: #495057 !important;
        }
        .btn-cancel:hover {
            background-color: #e9ecef !important;
            color: #212529 !important;
        }

        /* Category Tab Styling */
        .category-nav-wrapper {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 15px;
            margin-bottom: 25px;
            border: 1px solid #edf2f7;
        }

        .nav-pills .nav-link {
            border-radius: 12px;
            color: #4a5568;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .nav-pills .nav-link.active {
            background-color: #fff !important;
            color: #0d6efd !important;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.12);
            border-color: #0d6efd;
        }
        #pillar-list:hover {
            text-decoration: none;
            color: red;
            border-top:5px dotted green;
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
                    <div class="card border-0 shadow-sm" style="border-radius: 18px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="card-title mb-0 fw-bold">Pillars Explorer</h4>
                                @if (!isset($selectedCategory))
                                    <span class="badge bg-soft-danger text-danger px-3 py-2" style="border-radius: 8px;">
                                        <i class="icon-info"></i> Please select a category
                                    </span>
                                @endif
                            </div>

                            <!-- Categories (Tabs) -->
                            <div class="category-nav-wrapper">
                                <ul class="nav nav-pills d-flex flex-wrap gap-2" style="list-style-type: none; padding: 0;">
                                    @foreach ($categories as $category)
                                        <li class="nav-item" style="border-right:2px dashed orange; padding-right: 10px; margin-right: 10px;">
                                            <a id="pillar-list" style="" href="{{ route('pillars.show', ['category' => $category->id]) }}"
                                                class="category-tab nav-link {{ isset($selectedCategory) && $category->id == $selectedCategory->id ? 'active' : '' }}">
                                                <i class="icon-folder-alt mr-1"></i> {{ $category->category_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Tab Content -->
                            <div class="tab-content">


                            @foreach ($categories as $category)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="category-{{ $category->id }}" role="tabpanel"
                                    aria-labelledby="tab-{{ $category->id }}">
                                    <!-- Action Buttons and Search -->
                                    <div class="d-flex justify-content-center align-items-center mb-4 gap-3">
                                        <!-- Add Pillar Button -->
                                        <button type="button" class="btn btn-primary px-4 shadow-sm" data-bs-toggle="modal"
                                            data-bs-target="#addPillarModal" data-category-id="{{ $category->id }}">
                                            <i class="icon-plus"></i> Add Pillar
                                        </button>

                                        <!-- Choose Excel File Button -->
                                        <button type="button" class="btn btn-outline-danger px-4" data-bs-toggle="modal"
                                            data-bs-target="#uploadExcelModal">
                                            Choose Excel File
                                        </button>
                                    </div>

                                    <!-- Modal for Uploading Excel -->
                                    @include('admin.upload_excel_sheet')
                                </div>
                            @endforeach

                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Pillar Modal -->
            @include('admin.add_pillar_modal')

            <!-- Edit Pillar Modal -->
            @include('admin.edit_pillar_modal')
        </div>
    </div>

    @include('admin.script')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function filterPillars(categoryId, searchTerm) {
                const table = document.querySelector(`#category-${categoryId} table`);
                if (!table) {
                    console.error(`No table found for category ID: ${categoryId}`);
                    return;
                }

                const tableBody = table.querySelector('tbody');
                const rows = tableBody.querySelectorAll('tr');
                let visibleRowCount = 0;

                rows.forEach(row => {
                    const name = row.getAttribute('data-name') || '';
                    const pillarNumber = row.getAttribute('data-pillar-number') || '';
                    const planNumber = row.getAttribute('data-plan-number') || '';

                    if (
                        name.toLowerCase().includes(searchTerm) ||
                        pillarNumber.includes(searchTerm) ||
                        planNumber.includes(searchTerm)
                    ) {
                        row.style.display = '';
                        visibleRowCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                let noResultsRow = tableBody.querySelector('.no-results');
                if (visibleRowCount === 0) {
                    if (!noResultsRow) {
                        noResultsRow = document.createElement('tr');
                        noResultsRow.classList.add('no-results');
                        noResultsRow.innerHTML = `
                            <td colspan="12">
                                <p style="color: red; font-weight: bold; text-align: left;">
                                    Sorry, no record matched your input!
                                </p>
                            </td>`;
                        tableBody.appendChild(noResultsRow);
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
