<div class="table-container border" style="overflow-y: auto; max-height: 38rem; margin-top:10px; border-radius: 12px;">
    <table class="table table-hover pillar-table mb-0" id="category-{{ $category->id }}">
        <thead style="position: sticky; top: 0; z-index: 5; background: #ffffff; border-bottom: 2px solid #cbd5e0;">
            <tr class="bg-light">
                <th class="border-0 py-3 ps-4 fw-bold text-dark">Plan Number</th>
                <th class="border-0 py-3 fw-bold text-dark">Name of Individual</th>
                <th class="border-0 py-3 fw-bold text-dark" style="min-width: 220px;">Location</th>
                <th class="border-0 py-3 fw-bold text-dark">Pillar Number(s)</th>
                <th class="border-0 text-center fw-bold text-dark" style="width: 220px;">Actions</th>
            </tr>
        </thead>

        <tbody>
            @php
                $filteredPillars = $pillars->where('category_id', $category->id);
            @endphp

            @if ($filteredPillars->isEmpty())
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="py-4">
                            <i class="icon-info text-muted d-block mb-2" style="font-size: 2rem;"></i>
                            <p class="text-muted fw-bold">No pillars found for this category.</p>
                            <small class="text-secondary">Click "Add Pillar" to create your first record.</small>
                        </div>
                    </td>
                </tr>
            @else
                @foreach ($filteredPillars as $pillar)
                    <tr data-name="{{ strtolower($pillar->name) }}"
                        data-pillar-number="{{ strtolower($pillar->pillar_number) }}"
                        data-plan-number="{{ strtolower($pillar->plan_number) }}">

                        <td class="ps-4 py-3" style="vertical-align: middle;">
                            <span class="badge bg-white text-dark border border-secondary fw-bold"
                                style="font-size: 0.85rem;">{{ $pillar->plan_number }}</span>
                        </td>
                        <td class="fw-bold py-3" style="vertical-align: middle; color: #2d3748;">{{ $pillar->name }}
                        </td>
                        <td class="text-dark py-3" style="vertical-align: middle; line-height: 1.4; font-size: 0.9rem;">
                            {{ $pillar->location }}</td>
                        @php
                            $pillars = explode(',', $pillar->pillar_number);
                        @endphp

                        <td class="py-3 align-middle">
                            <div class="d-flex flex-wrap align-items-center gap-2">

                                @foreach (array_slice($pillars, 0, 3) as $index => $p)
                                    <span class="pillar-badge pillar-main"
                                        style="animation-delay: {{ $index * 0.2 }}s;">
                                        {{ trim($p) }}
                                    </span>
                                @endforeach

                                @if (count($pillars) > 3)
                                    <span class="pillar-badge pillar-extra" style="animation-delay: 0.5s;">
                                        +{{ count($pillars) - 3 }}
                                    </span>
                                @endif

                            </div>
                        </td>
                        <td class="text-center py-3" style="white-space: nowrap; vertical-align: middle;">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- View Button --}}
                                <button type="button" class="btn btn-success btn-sm px-3" data-bs-toggle="modal"
                                    data-bs-target="#viewPillarModal-{{ $pillar->id }}">
                                    <i class="icon-eye"></i> View
                                </button>

                                {{-- Edit Button --}}
                                <button type="button" class="btn btn-primary btn-sm px-3" data-bs-toggle="modal"
                                    data-bs-target="#editPillarModal-{{ $pillar->id }}">
                                    <i class="icon-note"></i> Edit
                                </button>

                                {{-- Delete --}}
                                <form action="{{ route('pillars.delete_pillar', $pillar->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm px-3 d-flex align-items-center gap-2"
                                        onclick="return confirm('Are you sure you want to delete this pillar record?');">
                                        <i class="icon-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

{{--  Separate Loop for Modals to prevent Table Layout breaking --}}
@foreach ($filteredPillars as $pillar)
    <div class="modal fade" id="viewPillarModal-{{ $pillar->id }}" tabindex="-1"
        aria-labelledby="viewPillarModalLabel-{{ $pillar->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius:28px; overflow:hidden;">

                {{-- Header --}}
                <div class="modal-header py-4 px-4"
                    style="background: linear-gradient(135deg, #f8f9fa, #ffffff); border-bottom:1px solid #edf2f7;">
                    <div>
                        <h5 class="modal-title fw-bold" id="viewPillarModalLabel-{{ $pillar->id }}">
                            Technical Specifications
                            <span class="badge bg-primary ms-2" style="border-radius:8px; font-size: 0.75rem;">REF:
                                {{ $pillar->plan_number }}</span>
                        </h5>
                        <p class="text-muted small mb-0">Full survey and coordinate records.</p>
                    </div>
                    <button type="button" class="btn border-0 shadow-none fw-bold btn-danger" data-bs-dismiss="modal"
                        style="ont-size: 1.5rem; line-height: 1;">X</button>
                </div>

                {{-- Body --}}
                <div class="modal-body p-4" style="background: #fafbfc;">
                    @php
                        $pNums = collect(explode(',', (string) $pillar->pillar_number))
                            ->map(fn($v) => trim($v))
                            ->filter(fn($v) => $v !== '')
                            ->values();
                        $eastings = collect(explode(',', (string) $pillar->eastings))
                            ->map(fn($v) => trim($v))
                            ->filter(fn($v) => $v !== '')
                            ->values();
                        $northings = collect(explode(',', (string) $pillar->northings))
                            ->map(fn($v) => trim($v))
                            ->filter(fn($v) => $v !== '')
                            ->values();
                        $origins = collect(explode(',', (string) $pillar->origin))
                            ->map(fn($v) => trim($v))
                            ->filter(fn($v) => $v !== '')
                            ->values();
                    @endphp

                    <div class="row g-3">
                        {{-- Left Column: General Info --}}
                        <div class="col-md-5">
                            <div class="row g-3">

                                @php
                                    $items = [
                                        ['label' => 'Plan Number', 'value' => $pillar->plan_number ?? 'N/A'],
                                        ['label' => 'Category', 'value' => $pillar->category->category_name ?? 'N/A'],
                                        ['label' => 'Pillar Name', 'value' => $pillar->name ?? 'N/A'],
                                        ['label' => 'Unit', 'value' => $pillar->unit ?? 'N/A'],
                                        ['label' => 'Height (m)', 'value' => $pillar->height ?? 'N/A'],
                                        ['label' => 'Survey Ref', 'value' => $pillar->survey ?? 'N/A'],
                                        ['label' => 'Location', 'value' => $pillar->location ?? 'N/A'],
                                    ];
                                @endphp

                                @foreach ($items as $item)
                                    <div class="col-12 col-md-6">

                                        <div class="p-3 rounded-3 h-100"
                                            style="
                                            background: linear-gradient(180deg, #ffffff, #fbfcfe);
                                            border: 1px solid #eef2f6;
                                            transition: all 0.2s ease;
                                        "
                                            onmouseover="this.style.transform='translateY(-2px)'"
                                            onmouseout="this.style.transform='translateY(0)'">

                                            <div
                                                style="
                                                font-size: 10.5px;
                                                letter-spacing: 1px;
                                                text-transform: uppercase;
                                                color: #6c757d;
                                                margin-bottom: 4px;
                                            ">
                                                {{ $item['label'] }}
                                            </div>

                                            <div
                                                style="
                                                font-size: 14px;
                                                font-weight: 600;
                                                color: #212529;
                                                line-height: 1.3;
                                                word-break: break-word;
                                            ">
                                                                            {{ $item['value'] }}
                                            </div>

                                        </div>

                                    </div>
                                @endforeach

                                {{-- Remarks full width --}}
                                <div class="col-12">

                                    <div class="p-3 rounded-3"
                                        style="
                                        background: #f8f9fa;
                                        border-left: 4px solid #dee2e6;
                                        border-radius: 12px;
                                    ">

                                        <div
                                            style="
                                        font-size: 10.5px;
                                        letter-spacing: 1px;
                                        text-transform: uppercase;
                                        color: #6c757d;
                                        margin-bottom: 6px;
                                    ">
                                                                    Remarks
                                        </div>

                                        <div
                                            style="
                                        font-size: 13px;
                                        font-weight: 500;
                                        color: #343a40;
                                    ">
                                                                    {{ $pillar->remarks ?? 'N/A' }}
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                        {{-- Right Column: Coordinate breakdown --}}
                        <div class="col-md-7">
                            <div class="card border-0 shadow-sm h-100 coord-card">

                                {{-- Header --}}
                                <div
                                    class="card-header coord-header py-3 d-flex justify-content-between align-items-center">

                                    <h6 class="mb-0 fw-semibold d-flex align-items-center gap-2">
                                        <i class="icon-layers text-primary"></i>
                                        Coordinates
                                    </h6>

                                    <span
                                        style="
                            font-size: 11px;
                            padding: 4px 10px;
                            border-radius: 999px;
                            background: rgba(13,110,253,0.08);
                            color: #0d6efd;
                            font-weight: 500;">
                                        {{ $pNums->count() }} Points
                                    </span>

                                </div>

                                {{-- Table --}}
                                <div class="table-responsive" style="max-height: 320px;">

                                    <table class="table mb-0 engineered-table">

                                        <thead>
                                            <tr>
                                                <th class="py-2">PILLAR NUMBER</th>
                                                <th class="py-2">EASTINGS</th>
                                                <th class="py-2">NORTHINGS</th>
                                                <th class="py-2">ORIGIN</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($pNums as $index => $pNum)
                                                <tr>

                                                    <td class="coord">
                                                        <span class="core-pill">
                                                            {{ $pNum }}
                                                        </span>
                                                    </td>

                                                    <td class="coord">
                                                        {{ $eastings[$index] ?? '—' }}
                                                    </td>

                                                    <td class="coord">
                                                        {{ $northings[$index] ?? '—' }}
                                                    </td>

                                                    <td class="coord">
                                                        {{ $origins[$index] ?? '—' }}
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>

                    {{-- Plan Preview --}}
                    @if (!empty($pillar->plan_document))
                        <div class="mt-3 p-3 bg-white shadow-sm"
                            style="border-radius: 20px; border: 1px solid #edf2f7;">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge bg-light text-dark border px-3" style="border-radius:8px;">Plan
                                    Document</span>
                                <small class="text-muted italic" style="font-size: 0.7rem;">Click image to
                                    expand</small>
                            </div>
                            <div class="text-center bg-light p-2 rounded">
                                <img src="{{ asset('storage/' . $pillar->plan_document) }}" class="img-fluid"
                                    style="max-height: 350px; border-radius:12px; cursor: zoom-in;"
                                    onclick="window.open(this.src, '_blank')">
                            </div>
                        </div>
                    @else
                        <div class="mt-3 p-4 bg-white shadow-sm text-center"
                            style="border-radius: 20px; border: 1px solid #edf2f7;">
                            <h6 class="text-uppercase text-secondary fw-bold small mb-2">Plan Document</h6>
                            <div class="py-3">
                                <span class="badge bg-light text-secondary border px-3">N/A - No Document
                                    Uploaded</span>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Footer --}}
                <div class="modal-footer bg-white border-top-0 px-4 pb-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success px-4" data-bs-toggle="modal"
                        data-bs-target="#editPillarModal-{{ $pillar->id }}" data-bs-dismiss="modal">
                        <i class="icon-note"></i> Edit Record
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach
