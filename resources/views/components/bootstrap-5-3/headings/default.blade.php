@props(['column', 'sortBy', 'sortDirection'])

@if ($column['sortable'])
    @if ($sortBy === $column['key'])
        <th scope="col">
            <div wire:click="sort('{{ $column['key'] }}')" style="cursor: pointer;" class="d-flex align-items-center p-3 {{ $column['thClass'] }}">
                {{ $column['label'] }}
                <span wire:loading wire:loading.delay wire:target="sort('{{ $column['key'] }}')"
                    class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>
                @if ($sortDirection === 'asc')
                    <i class="bi bi-arrow-down ms-2" wire:target="sort('{{ $column['key'] }}')"
                        wire:loading.class="d-none"></i>
                @else
                    <i class="bi bi-arrow-up ms-2" wire:target="sort('{{ $column['key'] }}')"
                        wire:loading.class="d-none"></i>
                @endif
            </div>
        </th>
    @else
        <th scope="col">
            <div wire:click="sort('{{ $column['key'] }}')" style="cursor: pointer;" class="d-flex align-items-center p-3 {{ $column['thClass'] }}">
                {{ $column['label'] }}
                <span wire:loading wire:loading.delay wire:target="sort('{{ $column['key'] }}')"
                    class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>
                <i class="bi bi-arrow-down-up ms-2" wire:target="sort('{{ $column['key'] }}')"
                    wire:loading.class="d-none"></i>
            </div>
        </th>
    @endif
@else
    <th scope="col">
        <div class="d-flex align-items-center p-3 {{ $column['thClass'] }}">
            {{ $column['label'] }}
        </div>
    </th>
@endif
