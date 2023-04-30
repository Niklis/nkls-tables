@props(['value', 'class'])

<td>
    <div class="d-flex align-items-center justify-content-center {{ $class }}">
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
