{{-- ✅ Edit Pillar Modals --}}
<style>
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
    .pillar-input-modern {
        border: 2px solid #f1f4f9;
        border-radius: 14px;
        padding: 0.75rem 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #f8fafc;
    }
    .pillar-input-modern:focus {
        border-color: #198754;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.1);
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
</style>
@foreach ($pillars as $pillar)
    <div class="modal fade" id="editPillarModal-{{ $pillar->id }}" tabindex="-1"
        aria-labelledby="editPillarModalLabel-{{ $pillar->id }}" aria-hidden="true">
       <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg mechanical-modal overflow-hidden">

                <div class="modal-header modal-header-modern py-4" style="background: linear-gradient(135deg, #198754 0%, #0f5132 100%);">
                    <div>
                        <h3 class="modal-title mb-1 fw-bold" id="editPillarModalLabel-{{ $pillar->id }}">Reconfigure Pillar</h3>
                        <p class="text-white-50 small mb-0">Record UUID: #{{ $pillar->id }} | System Update</p>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>

                <div class="modal-body p-4 p-lg-5">
                    <form action="{{ route('pillars.update_pillar', $pillar->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @php
                            $isThisModal = session('open_modal') === 'editPillarModal-' . $pillar->id;
                            $oldVal = fn($key, $fallback) => $isThisModal ? old($key, $fallback) : $fallback;
                        @endphp

                        <div class="row g-4">
                            <div class="col-md-12 mb-2">
                                <label class="input-label-modern">Category</label>
                                <select class="form-select pillar-input-modern" name="category_id" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (string)$oldVal('category_id', $pillar->category_id) === (string)$category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="input-label-modern">Plan Number</label>
                                <input type="text" class="form-control pillar-input-modern" name="plan_number" required
                                    value="{{ $oldVal('plan_number', $pillar->plan_number) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="input-label-modern">Pillar Designation ( Individual's name )</label>
                                <input type="text" class="form-control pillar-input-modern" name="name" required
                                    value="{{ $oldVal('name', $pillar->name) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="input-label-modern">Serial Indices (Pillar Numbers)</label>
                                <input type="text" class="form-control pillar-input-modern" name="pillar_number" required
                                    value="{{ $oldVal('pillar_number', $pillar->pillar_number) }}" placeholder="e.g. P-001, P-002">
                            </div>

                            <div class="col-md-12">
                                <label class="input-label-modern">Spatial Location</label>
                                <textarea class="form-control pillar-input-modern" name="location" rows="2" required>{{ $oldVal('location', $pillar->location) }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="input-label-modern text-success">Eastings Matrix</label>
                                <input type="text" class="form-control pillar-input-modern border-success-subtle" name="eastings" required
                                    value="{{ $oldVal('eastings', $pillar->eastings) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="input-label-modern text-danger">Northings Matrix</label>
                                <input type="text" class="form-control pillar-input-modern border-danger-subtle" name="northings" required
                                    value="{{ $oldVal('northings', $pillar->northings) }}">
                            </div>

                            <div class="col-md-12">
                                <label class="input-label-modern">Blueprint Archive</label>
                                <input type="file" class="form-control pillar-input-modern" name="plan_document" accept="image/*"
                                    data-preview-target="#editPlanPreview-{{ $pillar->id }}"
                                    data-preview-wrap="#editPlanPreviewWrap-{{ $pillar->id }}">

                                <div class="mt-3" id="editPlanPreviewWrap-{{ $pillar->id }}">
                                    <div class="preview-box border rounded-4 p-2 bg-light shadow-inner {{ $pillar->plan_document ? '' : 'd-none' }}">
                                        <img id="editPlanPreview-{{ $pillar->id }}"
                                             src="{{ $pillar->plan_document ? asset('storage/' . $pillar->plan_document) : '' }}"
                                             alt="Plan Preview"
                                             class="img-fluid rounded-3"
                                             style="max-height: 250px; object-fit: contain;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="input-label-modern">Technical Observations  ( Remarks )</label>
                                <textarea class="form-control pillar-input-modern" name="remarks" rows="2">{{ $oldVal('remarks', $pillar->remarks) }}</textarea>
                            </div>
                        </div>

                        <div class="modal-footer bg-light border-0 d-flex flex-row gap-3 p-4 px-0 mt-4">
                            <button type="button" class="btn btn-link text-muted fw-bold text-decoration-none" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success btn-execute flex-grow-1" style="background: #198754; box-shadow: 0 10px 20px -5px rgba(25, 135, 84, 0.3);">
                                <i class="icon-refresh me-2"></i> Commit Revision
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endforeach
