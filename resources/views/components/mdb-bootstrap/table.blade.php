@props(['class', 'theme'])

<div class="d-flex flex-column gap-3">
    <h5>Component: livewire:users.users-table | Theme: {{ $theme }}</h5>
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <x-nkls::mdb-bootstrap.search :class="$theme" />
            <button class="btn btn-primary ms-auto" wire:click="ft()" style="background-color: {{$test}}">
                New User
            </button>
        </div>
        <div class="card-body p-0">
            <table class="table align-middle mb-0 bg-white {{ $class }}">
                <thead class="bg-light">
                    <tr class="bg-white">
                        @foreach ($this->columns() as $column)
                            <x-dynamic-component :component="$column->thTmpl" :column="$column" :sortBy="$sortBy"
                                :sortDirection="$sortDirection" />
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->data() as $row)
                        <tr class="bg-white">
                            @foreach ($this->columns() as $column)
                                <x-dynamic-component :component="$column->tdTmpl" :column="$column" :value="$column->getValue($row, $column->key)" />
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            {{ $this->data()->links() }}
        </div>
    </div>
</div>
