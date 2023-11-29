@props(['value', 'column'])

<td>
    <div class="{{ $column['tdClass'] }}">
        <div @class([
            'badge',
            'bg-danger' => $value === 'deleted',
            'bg-success' => $value === 'active',
            'bg-warning' => $value === 'inactive',
        ])>
            {{ $value }}
        </div>
    </div>
</td>
