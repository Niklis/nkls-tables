@props(['value', 'column'])

<td>
    @if ($this->searchValue != '' && in_array($column->key, $this->searchColumns) && preg_match("/{$this->searchValue}/i", $value))
        <div class="p-3 d-flex align-items-center {{ $column->tdClass }}">
            {!! preg_replace('/(' . $this->searchValue . ')/i', "<mark style=\"padding: 0;\">$1</mark>", $value) !!}
        </div>
    @else
        <div class="p-3 d-flex align-items-center {{ $column->tdClass }}">{{ $value }}</div>
    @endif
</td>
