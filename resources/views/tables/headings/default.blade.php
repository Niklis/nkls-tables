@props(['column'])

{{-- multiSort --}}
@if ($this->multiSortEnabled)
    @if ($column['sortable'])
        @foreach ($this->config['sorts'] as $hash => $col)
            @if ($hash == $column['hash'])
                <th scope="col">
                    <div wire:click="sort('{{ $column['hash'] }}')" style="cursor: pointer;"
                        @if ($column['thClass']) class="{{ $column['thClass'] }}" @endif>
                        @lang($column['label'])
                        <span wire:loading wire:loading.delay wire:target="sort('{{ $column['hash'] }}')"
                            class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>
                        @if ($col['sortDir'] == 'asc')
                            <i class="bi bi-arrow-down ms-2" wire:target="sort('{{ $column['hash'] }}')"
                                wire:loading.class="d-none"></i>
                        @else
                            <i class="bi bi-arrow-up ms-2" wire:target="sort('{{ $column['hash'] }}')"
                                wire:loading.class="d-none"></i>
                        @endif
                    </div>
                </th>
            @endif
        @endforeach
    @else
        <th scope="col">
            <div class="{{ $column['thClass'] }}">
                @lang($column['label'])
            </div>
        </th>
    @endif
@else
    {{-- No multiSort --}}
    @if (isset($this->sortEnabled) && $this->sortEnabled && $column['sortable'])
        @if ($this->config['sortBy'] == $column['key'])
            <th scope="col">
                <div wire:click="sort('{{ $column['key'] }}')" style="cursor: pointer;"
                    @if ($column['thClass']) class="{{ $column['thClass'] }}" @endif>
                    @lang($column['label'])
                    <span wire:loading wire:loading.delay wire:target="sort('{{ $column['key'] }}')"
                        class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>
                    @if ($this->config['sortDirection'] == 'asc')
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
                <div wire:click="sort('{{ $column['key'] }}')" style="cursor: pointer;"
                    @if ($column['thClass']) class="{{ $column['thClass'] }}" @endif>
                    @lang($column['label'])
                    <span wire:loading wire:loading.delay wire:target="sort('{{ $column['key'] }}')"
                        class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>
                    <i class="bi bi-arrow-down-up ms-2" wire:target="sort('{{ $column['key'] }}')"
                        wire:loading.class="d-none"></i>
                </div>
            </th>
        @endif
    @else
        <th scope="col">
            <div class="{{ $column['thClass'] }}">
                @lang($column['label'])
            </div>
        </th>
    @endif
@endif
