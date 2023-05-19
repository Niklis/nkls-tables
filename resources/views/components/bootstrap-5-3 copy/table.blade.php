@props(['class' => '', 'theme'])

<div class="d-flex flex-column gap-3">
    {{-- Offline --}}
    @livewire('offline')
    <h5>Component: livewire:users.users-table | Theme: {{ $theme }}</h5>
    <div class="card">
        <div class="card-header d-flex align-items-center p-3">
            {{-- Global search --}}
            <x-dynamic-component :component="$this->searchTmpl" />
            {{-- New user button --}}
            <button class="btn btn-primary ms-auto" wire:click="ft()" wire:loading.attr="disabled"
                style="background-color: {{ $test }}">
                <span wire:loading wire:loading.delay wire:target="ft" class="spinner-border spinner-border-sm"
                    role="status" aria-hidden="true"></span>
                <span>New User</span>
            </button>
            {{-- Per page --}}
            <x-dynamic-component :component="$this->perPageTmpl" :class="'ms-3'" />
        </div>
        <div class="card-body p-0 position-relative">
            <table class="w-100 text-sm-start text-secondary {{ $class }}">
                <thead>
                    {{-- Header cells --}}
                    <tr class="bg-white">
                        @foreach ($this->columns as $column)
                            <x-dynamic-component :component="$column->thTmpl" :column="$column" :sortBy="$sortBy"
                                :sortDirection="$sortDirection" />
                        @endforeach
                    </tr>
                    {{-- Header filters cells --}}
                    @if (count($this->filters))
                        <tr class="bg-green">
                            @foreach ($this->columns as $column)
                                <x-dynamic-component :component="$column->filterTmpl" :column="$column" :class="'p-3'" />
                            @endforeach
                        </tr>
                    @endif
                </thead>
                <tbody>
                    {{-- Body cells --}}
                    @foreach ($this->data() as $row)
                        <tr class="bg-white">
                            @foreach ($this->columns as $column) 
                                <x-dynamic-component :component="$column->tdTmpl" :column="$column" :value="$column->getValue($row, $column->key)" />
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center p-3">
            {{ $this->data()->links() }}
            {{-- Per page --}}
            <x-dynamic-component :component="$this->perPageTmpl" :class="'ms-auto'" />
        </div>
    </div>
</div>
