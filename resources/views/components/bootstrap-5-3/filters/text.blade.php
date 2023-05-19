@props(['column', 'class' => ''])

<th>
    <div class="{{ $class }}">
        <input wire:model="filters.{{ $column['hash'] }}.val1" id="nkls_table_filter_{{ $column['hash'] }}" type="search"
            class="form-control" placeholder="{{ $column['label'] }}" />
    </div>
</th>
