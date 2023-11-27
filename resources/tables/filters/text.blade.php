@props(['column', 'class' => ''])

@php
    $filterValue = $this->getConfig('filters.' . $column['hash'] . '.val1') ?? null;
@endphp

<th>
    <div @if ($class) class="{{ $class }}" @endif>
        <input wire:model.live="config.filters.{{ $column['hash'] }}.val1" id="{{ $column['hash'] }}" type="search"
            class="form-control" placeholder="@lang($column['label'])" value="{{ $filterValue }}" />
    </div>
</th>
