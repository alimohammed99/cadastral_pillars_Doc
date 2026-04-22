@foreach ($pillars as $pillar)
<tr data-name="{{ strtolower($pillar->name) }}" data-pillar-number="{{ strtolower($pillar->pillar_number) }}"
    data-plan-number="{{ strtolower($pillar->plan_number) }}">
    <td>{{ $pillar->category->category_name }}</td>
    <td>{{ $pillar->pillar_number }}</td>
    <td>{{ $pillar->locality }}</td>
    <td>{{ $pillar->survey }}</td>
    <td>{{ $pillar->northings }}</td>
    <td>{{ $pillar->eastings }}</td>
    <td>{{ $pillar->height }}</td>
    <td>{{ $pillar->plan_number }}</td>
    <td>{{ $pillar->origin }}</td>
    <td>{{ $pillar->unit }}</td>
    <td>{{ $pillar->remarks }}</td>
    <td>
        <button class="btn btn-warning">Edit</button>
        <button class="btn btn-danger">Delete</button>
    </td>
</tr>
@endforeach