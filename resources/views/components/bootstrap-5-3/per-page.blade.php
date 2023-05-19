@props(['class' => ''])

@php
    $uid = getUid();
@endphp

<div class="{{ $class }}">
    <select wire:change="$set('perPageValue', nkls_table_per_page_{{ $uid }}.value)"
        id="nkls_table_per_page_{{ $uid }}" class="form-select">
        @foreach ($this->perPageOptions as $val)
            <option value="{{ $val }}" @if ($this->perPageValue == $val) selected @endif>
                {{ $val }}
            </option>
        @endforeach
    </select>
</div>
