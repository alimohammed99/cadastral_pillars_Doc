<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
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
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        /* Table Enhancements */
        .table-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            padding: 5px;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #edf2f7;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            font-weight: 700;
            color: #718096;
            padding: 16px;
        }

        .table tbody td {
            padding: 16px;
            vertical-align: middle;
            border-bottom: 1px solid #edf2f7;
            color: #2d3748;
        }

        .table tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.015);
        }

        /* Modal & Input Styling */
        .category-modal-content { border-radius: 20px; border: none; overflow: hidden; }
        .category-input { border-radius: 12px; padding: 12px 15px; border: 1px solid #e2e8f0; }
        .category-input:focus { box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15); border-color: #3182ce; }

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
                                <h4 class="card-title mb-0 fw-bold">Categories Management</h4>
                                <button type="button" class="btn btn-primary px-4 shadow-sm" data-bs-toggle="modal"
                                    data-bs-target="#addCategoryModal">
                                    <i class="icon-plus"></i> Add New Category
                                </button>
                            </div>

                            <div class="table-responsive table-container" style="max-height: 35rem; overflow-y: auto;">
                                <table class="table table-hover mb-0">
                                    <thead style="position: sticky; top: 0; z-index: 2; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                                        <tr>
                                            <th class="border-0">#</th>
                                            <th>Category Name</th>
                                            <th>Date Added</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $index => $category)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td class="fw-semibold">{{ $category->category_name }}</td>
                                                <td>{{ $category->created_at->format('F d, Y') }}</td>
                                                <td>
                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-success btn-sm px-3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editCategoryModal-{{ $category->id }}">
                                                        Edit
                                                    </button>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('categories.delete_category', $category->id) }}"
                                                        method="POST" style="display:inline;"
                                                        data-confirm="Are you sure you want to delete this category?">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm px-3"
                                                            onclick="return confirmDelete(this);">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ✅ Add Category Modal --}}
                <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content category-modal-content shadow-lg">
                            <div class="modal-header"
                                style="background: linear-gradient(135deg, rgba(13,110,253,.08), rgba(13,110,253,.02)); border-bottom:1px solid #f1f1f1;">
                                <div>
                                    <h5 class="modal-title mb-0 fw-bold" id="addCategoryModalLabel">Add New Category</h5>
                                    <small class="text-muted">Create a clean label for grouping pillars.</small>
                                </div>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                                    aria-label="Close">X</button>
                            </div>

                            <div class="modal-body">
                                <form action="{{ route('categories.store_category') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="category_name_add" class="form-label fw-semibold">Category
                                            Name</label>
                                        <input type="text" class="form-control category-input" id="category_name_add"
                                            name="category_name" placeholder="e.g. Block A / Zone 1" required>
                                    </div>

                                    <div class="modal-footer d-flex flex-column flex-sm-row gap-2 px-0 pb-0 border-0">
                                        <button type="submit" class="btn btn-primary w-100 w-sm-auto px-4">
                                            <i class="icon-check"></i> Save Category
                                        </button>
                                        <button type="button" class="btn btn-cancel w-100 w-sm-auto px-4"
                                            data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ✅ Edit Category Modals --}}
                @foreach ($categories as $category)
                    <div class="modal fade" id="editCategoryModal-{{ $category->id }}" tabindex="-1"
                        aria-labelledby="editCategoryModalLabel-{{ $category->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content category-modal-content shadow-lg">
                                <div class="modal-header"
                                    style="background: linear-gradient(135deg, rgba(25,135,84,.08), rgba(25,135,84,.02)); border-bottom:1px solid #f1f1f1;">
                                    <div>
                                        <h5 class="modal-title mb-0 fw-bold" id="editCategoryModalLabel-{{ $category->id }}">
                                            Edit Category</h5>
                                        <small class="text-muted">Adjust the label without breaking structure.</small>
                                    </div>
                                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                                        aria-label="Close">X</button>
                                </div>

                                <div class="modal-body">
                                    <form action="{{ route('categories.update_category', $category->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="category_name_edit_{{ $category->id }}"
                                                class="form-label fw-semibold">
                                                Category Name
                                            </label>
                                            <input type="text" class="form-control category-input"
                                                id="category_name_edit_{{ $category->id }}" name="category_name"
                                                value="{{ $category->category_name }}" required>
                                        </div>

                                        <div class="modal-footer d-flex flex-column flex-sm-row gap-2 px-0 pb-0 border-0">
                                             <button type="submit" class="btn btn-success w-100 w-sm-auto px-4">
                                                Save Changes
                                            </button>
                                            <button type="button" class="btn btn-cancel w-100 w-sm-auto px-4"
                                                data-bs-dismiss="modal">
                                                Cancel
                                            </button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        @include('admin/script')
        <script>
            function confirmDelete(button) {
                const form = button.closest('form');
                const message = form.getAttribute('data-confirm');
                return confirm(message);
            }
        </script>
    </div>
</body>

</html>
