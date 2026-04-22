{{--  Add Pillar Modal --}}
<div class="modal fade" id="addPillarModal" tabindex="-1" aria-labelledby="addPillarModalLabel" aria-hidden="true">
    <style>
        .mechanical-modal {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.05) !important;
            border-radius: 28px !important;
        }
        .modal-header-modern {
            background: linear-gradient(135deg, #0d6efd 0%, #004dc7 100%);
            color: white;
            border-bottom: none;
            padding: 2rem 2.5rem;
        }
        .pillar-input-modern {
            border: 2px solid #f1f4f9;
            border-radius: 14px;
            padding: 0.75rem 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: #f8fafc;
        }
        .pillar-input-modern:focus {
            border-color: #0d6efd;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
            transform: translateY(-1px);
        }
        select.pillar-input-modern {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23475569' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C2.185 5.355 2.401 5 2.737 5h9.525c.336 0 .552.355.286.658L7.753 11.14a.5.5 0 0 1-.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1.25rem center;
            background-size: 14px;
            padding-right: 3rem;
            cursor: pointer;
        }
        .input-label-modern {
            font-weight: 700;
            font-size: 0.85rem;
            color: #475569;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .btn-execute {
            background: #0d6efd;
            border: none;
            border-radius: 16px;
            padding: 12px 24px;
            font-weight: 700;
            box-shadow: 0 10px 20px -5px rgba(13, 110, 253, 0.3);
            transition: all 0.3s ease;
        }
        .btn-execute:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px -5px rgba(13, 110, 253, 0.4);
            background: #0b5ed7;
        }
        /* Modern Scrollbar Styling */
        .mechanical-modal .modal-body::-webkit-scrollbar {
            width: 8px;
        }
        .mechanical-modal .modal-body {
            max-height: calc(100vh - 250px);
            overflow-y: auto;
        }
        .mechanical-modal .modal-body::-webkit-scrollbar-track {
            background: #f8fafc;
            border-radius: 0 28px 28px 0;
        }
        .mechanical-modal .modal-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
    </style>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg mechanical-modal overflow-hidden">

            <div class="modal-header modal-header-modern">
                <div>
                    <h3 class="modal-title mb-1 fw-bold" id="addPillarModalLabel">Initialize Pillar</h3>
                    <p class="text-white-50 small mb-0">Input mechanical specifications and spatial data.</p>
                </div>
                <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>

            <form action="{{ route('pillars.store_pillar') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body p-4 p-lg-5">
                    <div class="row g-4">
                        <div class="col-md-12 mb-2">
                            <label class="input-label-modern">Category</label>
                            <select class="form-select pillar-input-modern" name="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ (string)old('category_id', $selectedCategory->id ?? '') === (string)$category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="input-label-modern">Plan Number</label>
                            <input type="text" class="form-control pillar-input-modern" name="plan_number" required
                                value="{{ old('plan_number') }}"
                                placeholder="PLN-000-X">
                        </div>

                        <div class="col-md-6">
                            <label class="input-label-modern">Pillar Designation ( Individual's name )</label>
                            <input type="text" class="form-control pillar-input-modern" name="name" required
                                value="{{ old('name') }}"
                                placeholder="Descriptive Name">
                        </div>

                        <div class="col-md-12">
                            <label class="input-label-modern">Node Indices (Pillar Numbers)</label>
                            <input type="text" class="form-control pillar-input-modern" name="pillar_number" required
                                value="{{ old('pillar_number') }}"
                                placeholder="P-001, P-002...">
                        </div>

                        <div class="col-md-12">
                            <label class="input-label-modern">Geospatial Locality(Location)</label>
                            <textarea class="form-control pillar-input-modern" name="location" rows="2" required
                                placeholder="Technical location description...">{{ old('location') }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="input-label-modern text-primary">Eastings Vector</label>
                            <input type="text" class="form-control pillar-input-modern border-primary-subtle" name="eastings" required
                                value="{{ old('eastings') }}"
                                placeholder="000.00, 111.11">
                        </div>

                        <div class="col-md-6">
                            <label class="input-label-modern text-danger">Northings Vector</label>
                            <input type="text" class="form-control pillar-input-modern border-danger-subtle" name="northings" required
                                value="{{ old('northings') }}"
                                placeholder="000.00, 111.11">
                        </div>

                        <div class="col-md-12">
                            <label class="input-label-modern">Visual Documentation (Blueprint)</label>
                            <input type="file" class="form-control pillar-input-modern"
                                name="plan_document" accept="image/*"
                                data-preview-target="#addPlanPreview" data-preview-wrap="#addPlanPreviewWrap">

                            <div class="mt-3 d-none" id="addPlanPreviewWrap">
                                <div class="preview-box border rounded-4 p-2 bg-light shadow-inner">
                                    <img id="addPlanPreview" src="" alt="Plan Preview" class="img-fluid rounded-3">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="input-label-modern">System Remarks</label>
                            <textarea class="form-control pillar-input-modern" name="remarks" rows="2"
                                placeholder="Optional notes...">{{ old('remarks') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-0 d-flex flex-row gap-3 p-4 px-lg-5 mb-4">
                    <button type="button" class="btn btn-link text-muted fw-bold text-decoration-none" data-bs-dismiss="modal">Abort</button>
                    <button type="submit" class="btn btn-primary btn-execute flex-grow-1">
                        <i class="icon-check me-2"></i> Commit Entry
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('change', function(e) {
    if (e.target && e.target.type === 'file' && e.target.matches('[data-preview-target]')) {
        const file = e.target.files[0];
        const targetSelector = e.target.getAttribute('data-preview-target');
        const wrapSelector = e.target.getAttribute('data-preview-wrap');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.querySelector(targetSelector);
                const wrap = document.querySelector(wrapSelector);
                if (img) img.src = event.target.result;
                if (wrap) wrap.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    }
});
</script>
