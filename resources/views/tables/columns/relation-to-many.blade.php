@props(['value', 'column'])

@php
// dd($value);
@endphp

<td>
    <div class="p-3 d-flex align-items-center {{ $column['tdClass'] }}">
        {!! $value !!}
    </div>
</td>
