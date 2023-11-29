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
    <div class="card-body position-relative p-0 px-3">
        <table @isset($config['tblClass']) class="{{ $config['tblClass'] }}" @endisset>
            @isset($config['caption'])
                <caption>{{ $config['caption'] }}</caption>
            @endisset
            <thead @isset($config['theadClass']) class="{{ $config['theadClass'] }}" @endisset>
                {{-- Header cells --}}
                <tr>
                    {{-- Bulk operations checkbox --}}
                    @if ($this->config['bulkOperations'])
                        <th class="text-center">
                            <div class="form-check">
                                <input class="form-check-input float-none" type="checkbox">
                            </div>
                        </th>
                    @endif

                    @foreach ($this->columns as $column)
                        @if ($column['mobile']['show'])
                            <x-dynamic-component :component="$column['thTmpl']" :column="$column" />
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody @isset($config['tbodyClass']) class="{{ $config['tbodyClass'] }}" @endisset>
                @foreach ($this->data() as $row)
                    {{-- Body cells --}}
                    <tr>
                        {{-- Bulk operations checkbox --}}
                        @if ($this->config['bulkOperations'])
                            <td>
                                <div class="form-check ps-3">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                            </td>
                        @endif
                        @foreach ($this->columns as $column)
                            @if ($column['mobile']['show'])
                                <x-dynamic-component :component="$column['tdTmpl']" :column="$column" :value="getColumnValue($row, $column['key'])" />
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
            @isset($config['tfoot'])
                <tfoot @isset($config['tfootClass']) class="{{ $config['tfootClass'] }}" @endisset>
                    {{-- Foot cells --}}
                    {{ $config['tfoot'] }}
                </tfoot>
            @endisset
        </table>
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
