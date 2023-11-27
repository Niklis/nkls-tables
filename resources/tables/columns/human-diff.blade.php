@props(['value', 'column'])

<td>
    <div class="{{ $column['tdClass'] }}">
        {{ \Carbon\Carbon::make($value)->diffForHumans() }}
    </div>
</td>
