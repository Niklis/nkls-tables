@props(['value', 'column'])

<td>
    <div class="p-3 d-flex align-items-center {{ $column['tdClass'] }}">
        {{ \Carbon\Carbon::make($value)->diffForHumans() }}
    </div>
</td>
