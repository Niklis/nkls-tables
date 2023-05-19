@props(['value', 'column'])

<td>
    <div class="{{ $column->tdClass }}">
        <div @class(['badge rounded-pill d-inline',
            'badge-danger' => $value === 'deleted',
            'badge-success' => $value === 'active',
            'badge-warning' => $value === 'inactive',
        ])>
            {{ $value }}
        </div>
    </div>
</td>
