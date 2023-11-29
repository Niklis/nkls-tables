@props(['class' => ''])

@php
    $uid = getTableUid();
@endphp

<div class="{{ $class }}">
    <select wire:change="setConfig('perPageValue', per_page_{{ $uid }}.value)"
        id="per_page_{{ $uid }}" class="form-select">
        @foreach ($this->config['perPageOptions'] as $val)
            <option value="{{ $val }}" @if ($this->config['perPageValue'] == $val) selected @endif>
                {{ $val }}
            </option>
        @endforeach
    </select>
</div>
