{{-- Offline --}}
@livewire('offline')

@if (session()->has('success'))
    <div class="alert alert-success align-self-center text-center col-4 ml-4 mr-4 mt-4" role="alert">
        {{ session('success') }}
    </div>
@endif
<div class="card">
    <div class="card-header d-flex">
        {{-- Global search --}}
        <x-dynamic-component :component="$this->searchTmpl" />
        {{-- Reset button --}}
        <button class="btn btn-warning ms-auto" wire:click="resetConfig">Reset All</button>
        {{-- New user button --}}
        <button class="btn btn-success ms-auto" wire:click="create" wire:loading.attr="disabled" data-bs-toggle="modal"
            data-bs-target="#{{ $modalId }}">
            <span wire:loading wire:loading.delay wire:target="create" class="spinner-border spinner-border-sm"
                role="status" aria-hidden="true"></span>
            <span>New {{ ucfirst($this->getEntityName()) }}</span>
        </button>
        {{-- Per page --}}
        <x-dynamic-component :component="$this->perPageTmpl" :class="'ms-3'" />
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
                        <x-dynamic-component :component="$column['thTmpl']" :column="$column" />
                    @endforeach
                </tr>
                {{-- Header filters cells --}}
                @if ($this->config['filtersEnabled'] && count($this->config['filters']))
                    <tr>
                        {{-- Bulk operations plug --}}
                        @if ($this->config['bulkOperations'])
                            <th>
                            </th>
                        @endif

                        @foreach ($this->columns as $column)
                            <x-dynamic-component :component="$column['filterTmpl']" :column="$column" />
                        @endforeach
                    </tr>
                @endif
            </thead>
            <tbody @isset($config['tbodyClass']) class="{{ $config['tbodyClass'] }}" @endisset>
                @foreach ($this->data() as $row)
                    {{-- Body cells --}}
                    <tr>
                        {{-- Bulk operations checkbox --}}
                        @if ($this->config['bulkOperations'])
                            <td class="text-center">
                                <div class="form-check">
                                    <input class="form-check-input float-none" type="checkbox">
                                </div>
                            </td>
                        @endif

                        @foreach ($this->columns as $column)
                            <x-dynamic-component :component="$column['tdTmpl']" :column="$column" :value="getColumnValue($row, $column['key'])" />
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
