@props(['value', 'column'])

@php
    //skip mark columns without filters
    if (isset($this->config['filters'][$column['hash']])) {
        $value = markSearchAndFilterResults($this, $column, $value);
    }
@endphp

<td>
    <div class="{{ $column['tdClass'] }}">{!! $value !!}</div>
</td>
