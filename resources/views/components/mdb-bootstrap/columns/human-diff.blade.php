@props(['value', 'column'])

<td>
    <div class="py-3 px-3 d-flex align-items-center justify-content-center {{ $column->tdClass }}">
        {{ \Carbon\Carbon::make($value)->diffForHumans() }}
    </div>
</td>
