@props(['value', 'column'])

<td>
    <div class="{{ $column['tdClass'] }}">{!! $value !!}</div>
</td>