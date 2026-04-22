<!-- Table Content (with pagination outside the scrollable table) -->
<div style="overflow-y: auto; max-height: 25rem; margin-top:10px">
    <table class="table table-striped pillar-table">
        <thead style="position: sticky; top: 0; z-index: 1;">
            <tr>
                <th style="background: yellow;">Category</th>
                <th style="background: salmon;">Pillar Number</th>
                <th style="background: lightgreen;">Locality</th>
                <th style="background: red;">Survey</th>
                <th style="background: pink;">Northings</th>
                <th style="background: lightcoral;">Eastings</th>
                <th style="background: lavender;">Height</th>
                <th style="background: lightblue;">Plan Number</th>
                <th style="background: orange;">Origin</th>
                <th style="background: beige;">Unit</th>
                <th style="background: aquamarine;">Remarks</th>
                <th style="background: red;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
            $filteredPillars = $pillars->where('category_id', $category->id);
            @endphp

            @if ($filteredPillars->isEmpty())
            <tr>
                <td colspan="12" class="text-center">
                    <marquee behavior="scroll" direction="left" scrollamount="10" style="color:red; font-weight:bold;">
                        No pillar for this category!
                    </marquee>
                </td>
            </tr>
            @else
            @foreach ($filteredPillars as $pillar)
            <tr data-name="{{ strtolower($pillar->name) }}"
                data-pillar-number="{{ strtolower($pillar->pillar_number) }}"
                data-plan-number="{{ strtolower($pillar->plan_number) }}">
                <td>{{ $pillar->category->category_name ?? 'N/A' }}</td>
                <td>{{ $pillar->pillar_number }}</td>
                <td>{{ $pillar->location }}</td>
                <td>{{ $pillar->survey ?? 'N/A' }}</td>
                <td>{{ $pillar->northings }}</td>
                <td>{{ $pillar->eastings }}</td>
                <td>{{ $pillar->height }}</td>
                <td>{{ $pillar->plan_number }}</td>
                <td>{{ $pillar->origin }}</td>
                <td>{{ $pillar->unit ?? 'N/A' }}</td>
                <td>{{ $pillar->remarks }}</td>
                <td>
                    <!-- Edit Button -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#editPillarModal-{{ $pillar->id }}">
                        Edit
                    </button>

                    <!-- Delete Button -->
                    <form action="{{ route('pillars.delete_pillar', $pillar->id) }}" method="POST"
                        style="display:inline;" data-confirm="Are you sure you want to delete this pillar?">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirmDelete(this);">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>

