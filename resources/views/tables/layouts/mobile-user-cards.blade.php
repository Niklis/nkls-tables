{{-- Offline --}}
@livewire('offline')

@if (session()->has('success'))
    <div class="alert alert-success align-self-center text-center col-4 ml-4 mr-4 mt-4" role="alert">
        {{ session('success') }}
    </div>
@endif
<div class="card">
    {{-- Header --}}
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
                <button class="btn btn-warning text-white" wire:click="resetConfig">
                    <i class="bi bi-x-circle"></i>
                </button>
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
    {{-- Table --}}
    <div class="card-body position-relative px-2 py-1">
        {{-- Rows --}}
        @foreach ($this->data() as $i => $row)
            {{--  Row item --}}
            <div class="card my-1">
                {{-- Item header --}}
                <div class="card-header d-flex align-items-center">
                    {{-- Bulk operations checkbox --}}
                    @if ($this->config['bulkOperations'])
                        <div class="form-check ps-3">
                            <input class="form-check-input" type="checkbox">
                        </div>
                    @endif
                    <a class="collapsed text-body w-100" data-bs-toggle="collapse"
                        data-bs-target="#{{ $tableId . '_r_' . $i }}" aria-expanded="false"
                        aria-controls="{{ $tableId . '_r_' . $i }}" id="{{ $tableId . '_r_header_' . $i }}">
                        @php
                            $this->columns = Arr::keyBy($this->columns, 'key');
                        @endphp
                        <div class="d-flex align-items-center gap-1 gap-sm-4">
                            <div class="d-flex flex-shrink-0">
                                <img src="{{ asset('/avatars/' . getColumnValue($row, $this->columns['profiles.avatar']['key'])) }}"
                                    class="img-thumbnail" loading="lazy" style="width: 48px;height: 48px;" />
                            </div>
                            <div class="d-flex flex-column">
                                <div class="fw-bold text-break">
                                    {{ getColumnValue($row, $this->columns['users.name']['key']) }}
                                </div>
                                <div class="fst-italic text-break">
                                    <i class="bi bi-envelope"></i>
                                    {{ getColumnValue($row, $this->columns['email']['key']) }}
                                </div>
                            </div>
                            @php
                                $value = getColumnValue($row, $this->columns['profiles.status']['key']);
                            @endphp
                            <div @class([
                                'fs-6 ms-auto badge text-break',
                                'bg-danger' => $value === 'deleted',
                                'bg-success' => $value === 'active',
                                'bg-warning' => $value === 'inactive',
                            ])>
                                {{ $value }}
                            </div>
                        </div>
                    </a>
                </div>
                {{-- Item body --}}
                <div id="{{ $tableId . '_r_' . $i }}" class="collapse"
                    aria-labelledby="{{ $tableId . '_r_header_' . $i }}">
                    <div class="card-body">
                        @foreach ($this->columns as $column)
                            {{-- {{dump($column['mobile']['cardHeader'])}} --}}
                            @if ($column['mobile']['cardHeader'] == false)
                                <dl class="row m-0 border-bottom border-light-subtle">
                                    <dt class="col p-0">
                                        {{ $column['label'] }}
                                    </dt>
                                    <dd class="col m-0">
                                        {{ getColumnValue($row, $column['key']) }}
                                    </dd>
                                </dl>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- Table footer --}}
    <div class="card-footer d-flex flex-wrap align-items-center">
        {{-- Pagination --}}
        {{ $this->data()->links('nkls::tables.pagination') }}

        <div class="ps-3">
            {{ $this->data()->total() }} @lang('items from') {{ $this->countItems }}
        </div>
        {{-- Per page --}}
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
