{{-- Offline --}}
@livewire('offline')

@if (session()->has('success'))
    <div class="alert alert-success align-self-center text-center col-4 ml-4 mr-4 mt-4" role="alert">
        {{ session('success') }}
    </div>
@endif
<div class="card">
    <div class="card-header">
        <div class="row gy-2">
            <div class="col-sm-6">
                {{-- Global search --}}
                <x-dynamic-component :component="$this->searchTmpl" />
            </div>
            <div class="col-auto col-sm-12 d-flex gap-1 order-sm-first">
                {{-- Sorts button --}}
                @if ($this->config['sortEnabled'])
                    <button class="btn btn-primary text-white d-lg-none" wire:click="openSorts"
                        wire:loading.attr="disabled" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                        <span wire:loading wire:loading.delay wire:target="openSorts"
                            class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <i class="bi bi-arrow-down-up"></i>
                    </button>
                @endif
                {{-- Filters button --}}
                @if ($this->config['filtersEnabled'] && count($this->config['filters']))
                    <button class="btn btn-primary text-white d-lg-none" wire:click="openFilters"
                        wire:loading.attr="disabled" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                        <span wire:loading wire:loading.delay wire:target="openFilters"
                            class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <i class="bi bi-funnel"></i>
                    </button>
                @endif
                {{-- Reset button --}}
                <button class="btn btn-warning text-white" wire:click="resetConfig">Reset All</button>
                {{-- New user button --}}
                <button class="btn btn-success text-white ms-auto" wire:click="create" wire:loading.attr="disabled"
                    data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                    <span wire:loading wire:loading.delay wire:target="create" class="spinner-border spinner-border-sm"
                        role="status" aria-hidden="true"></span>
                    <i class="bi bi-person-add"></i>
                </button>
            </div>
            {{-- Per page --}}
            <div class="col-auto ms-auto">
                <x-dynamic-component :component="$this->perPageTmpl" :class="''" />
            </div>
        </div>
    </div>

    <div class="card-body position-relative px-2 py-1">
        @foreach ($this->data() as $i => $row)
            {{-- Card body (table row) --}}
            <div class="card my-1">
                <div class="card-header">
                    <a class="collapsed d-flex " data-bs-toggle="collapse"
                        data-bs-target="#{{ $this->id . '_r_' . $i }}" aria-expanded="false"
                        aria-controls="{{ $this->id . '_r_' . $i }}" id="{{ $this->id . '_r_header_' . $i }}">
                        <div class="d-flex aling-items-center gap-3">
                            @foreach ($this->columns as $column)
                                {{-- {{ dump(@end(explode('.', $column['key']))) }} --}}
                                @if ($column['mobile']['cardHeader'])
                                    <dl class="d-flex flex-column">
                                        <dt>
                                            {{ $column['label'] }}
                                        </dt>
                                        <dd>
                                            {{ getColumnValue($row, $column['key']) }}
                                        </dd>
                                    </dl>
                                @endif
                            @endforeach
                        </div>
                    </a>
                </div>
                <div id="{{ $this->id . '_r_' . $i }}" class="collapse"
                    aria-labelledby="{{ $this->id . '_r_header_' . $i }}">
                    <div class="card-body">
                        @foreach ($this->columns as $column)
                            <div>
                                <div>
                                    {{ $column['label'] }}
                                </div>
                                <div>
                                    {{ getColumnValue($row, $column['key']) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="card-footer d-flex flex-wrap align-items-center">
        {{-- Pagination --}}
        {{ $this->data()->links('nkls::tables.pagination') }}

        <div class="ps-3">
            {{ $this->data()->total() }} @lang('items from') {{ $this->countItems }}
        </div>
        <x-dynamic-component :component="$this->perPageTmpl" :class="'ms-auto'" />
    </div>
</div>
{{-- Modal start --}}
<div wire:ignore.self class="modal fade" id="{{ $modalId }}" tabindex="-1"
    aria-labelledby="{{ $modalId }}Label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            @if ($modalBody != '')
                @include($modalBody)
            @endif
        </div>
    </div>
</div>
{{-- Modal end --}}
