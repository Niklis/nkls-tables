@props(['column', 'class' => ''])

<th>
    <div class="{{ $class }}">{{ $column->hash }}
        {{-- <input wire:change="filter('{{ $column->key }}', nkls_table_filter_{{ $uid }}.value)" --}}
        <input wire:model="filters.{{ $column->hash }}.val1" id="nkls_table_filter_{{ $column->hash }}" type="search"
            class="form-control" placeholder="{{ $column->label }}" />
        {{-- value="{{$this->filters[$column->key]['val1']}}"/> --}}
    </div>
</th>
