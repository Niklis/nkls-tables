@props(['value', 'column'])

<td>
    <div class="p-3 d-flex align-items-center {{ $column['tdClass'] }}">
        <div @class([
            'text-white rounded-1 px-1 text-center',
            'bg-danger' => $value === 'deleted',
            'bg-success' => $value === 'active',
            'bg-warning' => $value === 'inactive',
        ])>
            {{ $value }}
        </div>
    </div>
</td>
